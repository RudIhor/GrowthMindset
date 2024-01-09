<?php

namespace App\Telegram;

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
    /**
     * @var array<string, string>
     */
    private array $availableCommands = [
        '/randomQuote' => 'Get a random awesome quote.',
    ];

    public function __construct(private readonly QuoteService $quoteService)
    {
        parent::__construct();
    }

    public function handleUnknownCommand(Stringable $text): void
    {
        Log::info($text->value());

        $this->reply('Please, check the available commands: /help');
    }

    public function start(): void
    {
        if (!TelegramUser::chatId($this->chat->chat_id)->first() && !empty($this->message)) {
            TelegramUser::create([
                'chat_id' => $this->message->chat()?->id(),
                'first_name' => $this->message->from()?->firstName(),
                'last_name' => $this->message->from()?->lastName(),
                'username' => $this->message->from()?->username(),
            ]);
        }

        $this->reply("👋 Welcome to QuoteBo! I'm here to inspire and motivate you, making your day with awesome quotes. First, you need to set up your /settings to determine your preferences. After that, use /subscribe to start receiving your awesome quotes. If you have any questions or need assistance, feel free to type /help. Let's get started! 🚀");
    }

    public function help(): void
    {
        $message = "*Here are all available commands:*\n";
        foreach ($this->availableCommands as $command => $description) {
            $message .= "\n" . $command . ' ' . $description;
        }

        $this->reply($message);
    }

    public function setNotificationsAmount(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();
        $notificationsPerDay = $this->data->get('number');
        if (empty($telegramUser->setting)) {
            $userSettings = new UserSetting();
            $userSettings->telegram_user_id = $telegramUser->id;
            $userSettings->notifications_per_day = $notificationsPerDay;
            $userSettings->save();
        } else {
            $telegramUser->setting->notifications_per_day = $notificationsPerDay;
            $telegramUser->setting->save();
        }

        $this->reply('Settings were successfully updated!');
        Telegraph::chat($this->chat)->message('Start receive your quotes: /subscribe')->send();
    }

    public function settings(): void
    {
        Telegraph::chat($this->chat)
                 ->message('How many quote do you want to receive each day?')
                 ->keyboard(Keyboard::make()->buttons([
                     Button::make('5')->action('setNotificationsAmount')->param('number', 5),
                     Button::make('7')->action('setNotificationsAmount')->param('number', 7),
                     Button::make('9')->action('setNotificationsAmount')->param('number', 9),
                     Button::make('10')->action('setNotificationsAmount')->param('number', 10),
                     Button::make('12')->action('setNotificationsAmount')->param('number', 12),
                     Button::make('14')->action('setNotificationsAmount')->param('number', 14),
                 ]))
                 ->send();
    }

    /**
     * @throws \Throwable
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
                $this->reply("You have to setup: /settings");

                return;
            }
            Subscription::create([
                'telegram_user_id' => $telegramUser->id,
                'is_active' => SubscriptionType::ACTIVE->value,
            ]);
            SendQuoteJob::dispatch($telegramUser)->delay(5);
        }
        $this->reply("You've just subscribed. Soon, you'll get your first quote!");
    }

    public function unsubscribe(): void
    {
        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::chatId($this->chat->chat_id)->first();
        $subscription = Subscription::telegramUserId($telegramUser->id)->first();
        if (!empty($subscription)) {
            $subscription->is_active = SubscriptionType::NONACTIVE->value;
            $subscription->save();
        }

        $this->reply("You've just unsubscribed!");
    }

    public function randomQuote(): void
    {
        $this->reply($this->quoteService->getRandomQuoteMessage());
    }
}
