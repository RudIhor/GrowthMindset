<?php

namespace App\Jobs;

use App\Models\TelegramUser;
use App\Services\QuoteService;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SendQuoteJob implements ShouldQueue, ShouldBeUnique, ShouldBeUniqueUntilProcessing
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param \App\Models\TelegramUser $telegramUser
     */
    public function __construct(
        private readonly TelegramUser $telegramUser
    ) {
    }

    /**
     * @param \App\Services\QuoteService $quoteService
     * @return void
     */
    public function handle(QuoteService $quoteService): void
    {
        $from = (new Carbon('today'))->setHour((int)config('timeschedule.from.hours'));
        $to = (new Carbon('today'))->setHour((int)config('timeschedule.to.hours'));
        if ($this->telegramUser->subscription->is_active) {
            $seconds = (int)config('timeschedule.notifications.' . $this->telegramUser->setting->notifications_per_day . '.step');
            if (now()->between($from, $to)) {
                Telegraph::chat($this->telegramUser->chat_id)
                         ->message($quoteService->getRandomQuoteMessage())
                         ->send();
            } else {
                $seconds = (int)now()->diffInSeconds((new Carbon('tomorrow'))
                    ->setHours((int)config('timeschedule.from.hours'))
                    ->setSeconds((int)config('timeschedule.from.seconds')));
            }
            self::dispatch($this->telegramUser)->delay($seconds);
        }
    }

    /**
     * @return array<int, object>
     */
    public function middleware(): array
    {
        /** @phpstan-ignore-next-line  */
        return [new WithoutOverlapping($this->uniqueId())];
    }

    /**
     * @return int
     */
    public function uniqueId(): int
    {
        return $this->telegramUser->id;
    }
}
