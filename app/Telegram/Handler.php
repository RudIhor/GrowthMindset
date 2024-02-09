<?php

namespace App\Telegram;

use App\Actions\Subscription\{CreateSubscriptionAction, UpdateSubscriptionAction};
use App\Actions\TelegramUser\{CreateTelegramUserAction, UpdateTelegramUserLanguageAction};
use App\Actions\UserSetting\CreateUserSettingAction;
use App\DTOs\Subscription\{StoreSubscriptionDTO, UpdateSubscriptionDTO};
use App\DTOs\TelegramUser\{StoreTelegramUserDTO, UpdateTelegramUserLanguageDTO};
use App\DTOs\UserSetting\StoreUserSettingDTO;
use App\Enums\{LanguageCode, SubscriptionType, Time};
use App\Jobs\SendQuoteJob;
use App\Models\{TelegramUser};
use App\Services\QuoteService;
use App\Services\Telegram\ButtonService;
use App\Services\Telegram\MessageService;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    private string $languageCode;
    private MessageService $messageService;

    public function __construct(
        private readonly QuoteService $quoteService,
        private readonly CreateTelegramUserAction $createTelegramUserAction,
        private readonly CreateSubscriptionAction $createSubscriptionAction,
        private readonly UpdateSubscriptionAction $updateSubscriptionAction,
        private readonly CreateUserSettingAction $createUserSettingAction,
        private readonly UpdateTelegramUserLanguageAction $updateTelegramUserLanguageAction,
        private readonly ButtonService $buttonService,
    ) {
        parent::__construct();
    }

    protected function setupChat(): void
    {
        $this->languageCode = TelegramUser::whereChatId((string) $this->message?->from()?->id())->first()->language_code
            ?? $this->message?->from()?->languageCode()
            ?? LanguageCode::EN->value;
        $this->messageService = new MessageService($this->languageCode);
        parent::setupChat();
    }

    public function handleUnknownCommand(Stringable $text): void
    {
        $this->reply($this->messageService->handleUnknownCommand());
    }

    public function start(): void
    {
        if (!TelegramUser::whereChatId($this->chat->chat_id)->first()) {
            $this->createTelegramUserAction->execute(new StoreTelegramUserDTO($this->message, $this->languageCode));
        }

        $this->reply($this->messageService->start());
    }

    public function help(): void
    {
        $this->reply($this->messageService->help());
    }

    /**
     * @return void
     */
    public function settings(): void
    {
        Telegraph::chat($this->chat)
            ->message(__('bot.how_many_quotes', locale: $this->languageCode))
            ->keyboard(Keyboard::make()->buttons($this->buttonService->availableOptions()))
            ->send();
        Telegraph::chat($this->chat)
            ->message(__('bot.choose_language', locale: $this->languageCode))
            ->keyboard(Keyboard::make()->buttons($this->buttonService->languageButtons()))
            ->send();
    }

    /**
     * @return void
     */
    public function subscribe(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::whereChatId($this->chat->chat_id)->first();
        if (!empty($telegramUser->subscription)) {
            if (!$telegramUser->subscription->is_active) {
                $this->updateSubscriptionAction->execute(
                    new UpdateSubscriptionDTO($this->chat->chat_id, SubscriptionType::Active->value)
                );
                SendQuoteJob::dispatch($telegramUser)->delay(Time::Hour->value);
            }
        } else {
            if (empty($telegramUser->setting)) {
                $this->reply(__('bot.need_settings', locale: $this->languageCode));

                return;
            }
            $this->createSubscriptionAction->execute(
                new StoreSubscriptionDTO($telegramUser->id, SubscriptionType::Active->value)
            );
            SendQuoteJob::dispatch($telegramUser)->delay(Time::Hour->value);
        }
        $this->reply(__('bot.subscribed', locale: $this->languageCode));
    }

    /**
     * @return void
     */
    public function unsubscribe(): void
    {
        $this->updateSubscriptionAction->execute(
            new UpdateSubscriptionDTO($this->chat->chat_id, SubscriptionType::NonActive->value)
        );
        $this->reply($this->messageService->unSubscribe());
    }

    /**
     * @return void
     */
    public function randomQuote(): void
    {
        $this->reply($this->quoteService->getRandomQuoteMessage($this->languageCode));
    }

    /**
     * @return void
     */
    public function mySettings(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::whereChatId($this->chat->chat_id)->first();
        $this->reply($this->messageService->mySettings($telegramUser->setting->notifications_per_day));
    }

    /**
     * @return void
     */
    public function setNotificationsAmount(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::whereChatId($this->chat->chat_id)->first();
        $notificationsPerDay = $this->data->get('number');
        if (empty($telegramUser->setting)) {
            $this->createUserSettingAction->execute(new StoreUserSettingDTO($telegramUser->id, $notificationsPerDay));
        } else {
            $telegramUser->setting->notifications_per_day = $notificationsPerDay;
            $telegramUser->setting->save();
        }
        $this->reply($this->messageService->setNotificationsAmount());
    }

    /**
     * @return void
     */
    public function setLanguageCode(): void
    {
        $this->updateTelegramUserLanguageAction->execute(
            new UpdateTelegramUserLanguageDTO($this->chat->chat_id, $this->data->get('language_code'))
        );
        $this->reply($this->messageService->setLanguageCode());
    }
}
