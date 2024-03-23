<?php

namespace Modules\Telegram\app;

use App\Enums\Time;
use App\Jobs\SendQuoteJob;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;
use Modules\Quote\app\Services\QuoteService;
use Modules\Telegram\app\Actions\Rate\CreateRateAction;
use Modules\Telegram\app\Actions\Subscription\CreateSubscriptionAction;
use Modules\Telegram\app\Actions\Subscription\UpdateSubscriptionAction;
use Modules\Telegram\app\Actions\TelegramUser\CreateTelegramUserAction;
use Modules\Telegram\app\Actions\TelegramUser\UpdateTelegramUserLanguageAction;
use Modules\Telegram\app\Actions\TelegramUserSetting\CreateUserSettingAction;
use Modules\Telegram\app\DTOs\Rate\StoreRateDTO;
use Modules\Telegram\app\DTOs\Subscription\StoreSubscriptionDTO;
use Modules\Telegram\app\DTOs\Subscription\UpdateSubscriptionDTO;
use Modules\Telegram\app\DTOs\TelegramUser\StoreTelegramUserDTO;
use Modules\Telegram\app\DTOs\TelegramUser\UpdateTelegramUserLanguageDTO;
use Modules\Telegram\app\DTOs\UserSetting\StoreUserSettingDTO;
use Modules\Telegram\app\Enums\LanguageCode;
use Modules\Telegram\app\Enums\SubscriptionType;
use Modules\Telegram\app\Models\TelegramUser;
use Modules\Telegram\app\Services\ButtonService;
use Modules\Telegram\app\Services\MessageService;

class Handler extends WebhookHandler
{
    private string $languageCode;
    private MessageService $messageService;

    public function __construct(
        private readonly QuoteService $quoteService,
        private readonly CreateTelegramUserAction $createTelegramUserAction,
        private readonly CreateSubscriptionAction $createSubscriptionAction,
        private readonly CreateUserSettingAction $createUserSettingAction,
        private readonly CreateRateAction $createRateAction,
        private readonly UpdateSubscriptionAction $updateSubscriptionAction,
        private readonly UpdateTelegramUserLanguageAction $updateTelegramUserLanguageAction,
        private readonly ButtonService $buttonService,
    ) {
        parent::__construct();
    }

    protected function setupChat(): void
    {
        parent::setupChat();
        $this->languageCode = TelegramUser::whereChatId($this->chat->chat_id)->first()->language_code
            ?? $this->message?->from()?->languageCode()
            ?? LanguageCode::UK->value;
        $this->messageService = new MessageService($this->languageCode);
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
    public function rateUs(): void
    {
        Telegraph::chat($this->chat)
            ->message(__('bot.rate_us', locale: $this->languageCode))
            ->keyboard(Keyboard::make()->buttons($this->buttonService->rateButtons()))
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
        Telegraph::chat($this->chat)->message($this->messageService->setNotificationsAmount())->send();
    }

    /**
     * @return void
     */
    public function setLanguageCode(): void
    {
        $this->updateTelegramUserLanguageAction->execute(
            new UpdateTelegramUserLanguageDTO($this->chat->chat_id, $this->data->get('language_code'))
        );
    }

    public function setRating(): void
    {
        $this->createRateAction->execute(
            new StoreRateDTO($this->chat->chat_id, $this->data->get('value'))
        );
        Telegraph::chat($this->chat)->message($this->messageService->setRating())->send();
    }
}
