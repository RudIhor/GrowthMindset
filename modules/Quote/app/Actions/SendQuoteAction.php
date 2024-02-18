<?php

namespace Modules\Quote\app\Actions;

use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Support\Carbon;
use Modules\Quote\app\Jobs\SendQuoteJob;
use Modules\Quote\app\Services\QuoteService;
use Modules\Telegram\app\Models\TelegramUser;

class SendQuoteAction
{
    public function __construct(readonly private TelegramUser $telegramUser) {}

    /**
     * @param QuoteService $quoteService
     * @return void
     */
    public function execute(QuoteService $quoteService): void
    {
        $start = $this->getStartTime();
        $end = $this->getEndTime();
        $midnight = $this->getMidnightTime();
        if ($this->isSubscriptionIsActive()) {
            $seconds = $this->getSecondsAccordingNotificationsAmount();
            if ($this->isNowBetween($start, $end)) {
                $this->sendQuoteNow($quoteService);
            } elseif ($this->isNowBetween($midnight, $start)) {
                $seconds = $this->calculateSecondsToTodayStart();
            } else {
                $seconds = $this->calculateSecondsToTomorrowStart();
            }
            SendQuoteJob::dispatch($this->telegramUser)->delay($seconds);
        }
    }

    /**
     * @return int
     */
    private function getSecondsAccordingNotificationsAmount(): int
    {
        return (int)config('timeschedule.notifications.' . $this->telegramUser->setting->notifications_per_day . '.step');
    }

    /**
     * @return int
     */
    private function calculateSecondsToTomorrowStart(): int
    {
        return (int)now()->diffInSeconds((new Carbon('tomorrow'))
            ->setHours((int)config('timeschedule.from.hours'))
            ->setSeconds((int)config('timeschedule.from.seconds')));
    }
    /**
     * @return int
     */
    private function calculateSecondsToTodayStart(): int
    {
        return (int)now()->diffInSeconds((new Carbon())
            ->setHours((int)config('timeschedule.from.hours'))
            ->setSeconds((int)config('timeschedule.from.seconds')));
    }

    /**
     * @param QuoteService $quoteService
     * @return void
     */
    private function sendQuoteNow(QuoteService $quoteService): void
    {
        Telegraph::chat((string) $this->telegramUser->chat_id)
            ->message($quoteService->getRandomQuoteMessage($this->telegramUser->language_code))
            ->silent()
            ->send();
    }

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @return bool
     */
    private function isNowBetween(Carbon $start, Carbon $end): bool
    {
        return now()->between($start, $end);
    }

    /**
     * @return Carbon
     */
    private function getStartTime(): Carbon
    {
        return (new Carbon('today'))->setHour((int)config('timeschedule.from.hours'));
    }

    /**
     * @return Carbon
     */
    private function getEndTime(): Carbon
    {
        return (new Carbon('today'))->setHour((int)config('timeschedule.to.hours'));
    }

    /**
     * @return Carbon
     */
    private function getMidnightTime(): Carbon
    {
        return (new Carbon())->setHours(0)->setMinutes(0)->setSeconds(0);
    }

    /**
     * @return int
     */
    private function isSubscriptionIsActive(): int
    {
        return $this->telegramUser->subscription->is_active;
    }
}
