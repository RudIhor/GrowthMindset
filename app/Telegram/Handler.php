<?php

namespace App\Telegram;

use App\Constants\Flag;
use App\Enums\SubscriptionType;
use App\Enums\Time;
use App\Jobs\SendQuoteJob;
use App\Models\Subscription;
use App\Models\TelegramUser;
use App\Models\UserSetting;
use App\Services\QuoteService;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function __construct(private readonly QuoteService $quoteService)
    {
        parent::__construct();
    }

    public function handleUnknownCommand(Stringable $text): void
    {
        Log::channel('db')->info($text->value(), ['chat_id' => $this->chat->chat_id]);

        $this->reply(__('bot.handle_unknown_command', locale: $this->message?->from()?->languageCode()));
    }

    public function start(): void
    {
        $languageCode = $this->message?->from()?->languageCode();
        if (!TelegramUser::chatId($this->chat->chat_id)->first()) {
            TelegramUser::create([
                'chat_id' => $this->message?->chat()?->id(),
                'first_name' => $this->message?->from()?->firstName(),
                'last_name' => $this->message?->from()?->lastName(),
                'username' => $this->message?->from()?->username(),
                'language_code' => $languageCode,
            ]);
        }

        $this->reply(__('bot.welcome', locale: $languageCode));
    }

    public function help(): void
    {
        $this->reply(__('bot.help', locale: $this->message?->from()?->languageCode()));
    }

    /**
     * @return void
     */
    public function settings(): void
    {
        $buttons = array_map(function ($value) {
            return Button::make($value)->action('setNotificationsAmount')->param('number', $value);
        }, config('quotes.available_options'));
        $languages = array_map(function ($value) {
            return Button::make(Flag::getEmoji($value))->action('setLanguageCode')->param('language_code', $value);
        }, config('quotes.available_languages'));
        Telegraph::chat($this->chat)
            ->message(__('bot.how_many_quotes', locale: $this->message?->from()?->languageCode()))
            ->keyboard(Keyboard::make()->buttons($buttons))
            ->send();
        Telegraph::chat($this->chat)
            ->message(__('bot.choose_language', locale: $this->message?->from()?->languageCode()))
            ->keyboard(Keyboard::make()->buttons($languages))
            ->send();
    }

    /**
     * @return void
     */
    public function subscribe(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();
        if (!empty($telegramUser->subscription)) {
            if (!$telegramUser->subscription->is_active) {
                Subscription::whereId($telegramUser->subscription->id)->update([
                    'is_active' => SubscriptionType::ACTIVE,
                ]);
                SendQuoteJob::dispatch($telegramUser)->delay(Time::Hour->value);
            }
        } else {
            if (empty($telegramUser->setting)) {
                $this->reply(__('bot.need_settings', locale: $this->message?->from()?->languageCode()));

                return;
            }
            Subscription::create([
                'telegram_user_id' => $telegramUser->id,
                'is_active' => SubscriptionType::ACTIVE->value,
            ]);
            SendQuoteJob::dispatch($telegramUser)->delay(Time::Hour->value);
        }
        $this->reply(__('bot.subscribed', locale: $this->message?->from()?->languageCode()));
    }

    /**
     * @return void
     */
    public function unsubscribe(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();
        $subscription = Subscription::telegramUserId($telegramUser->id)->first();
        if (!empty($subscription)) {
            $subscription->is_active = SubscriptionType::NONACTIVE->value;
            $subscription->save();
        }

        $this->reply(__('bot.unsubscribed', locale: $this->message?->from()?->languageCode()));
    }

    /**
     * @return void
     */
    public function randomQuote(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();

        $this->reply($this->quoteService->getRandomQuoteMessage($telegramUser->language_code));
    }

    /**
     * @return void
     */
    public function mySettings(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();

        $this->reply(
            sprintf(__('bot.my_settings', locale: $this->message?->from()?->languageCode()),
                $telegramUser->setting->notifications_per_day,
                Flag::getEmoji($telegramUser->language_code))
        );
    }

    /**
     * @return void
     */
    public function setNotificationsAmount(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();
        $notificationsPerDay = $this->data->get('number');
        if (empty($telegramUser->setting)) {
            UserSetting::create([
                'telegram_user_id' => $telegramUser->id,
                'notifications_per_day' => $notificationsPerDay,
            ]);
        } else {
            $telegramUser->setting->notifications_per_day = $notificationsPerDay;
            $telegramUser->setting->save();
        }
        $this->reply(__('bot.settings_updated', locale: $this->message?->from()?->languageCode()));

        Telegraph::chat($this->chat)
                 ->message(__('bot.start_receive', locale: $this->message?->from()?->languageCode()))
                 ->send();
    }

    /**
     * @return void
     */
    public function setLanguageCode(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();
        $telegramUser->update([
            'language_code' => $this->data->get('language_code'),
        ]);
        $this->reply(__('bot.language_updated', locale: $this->message?->from()?->languageCode()));
    }
}
