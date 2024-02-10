<?php

namespace App\Jobs;

use App\Actions\Quote\SendQuoteAction;
use App\Models\TelegramUser;
use App\Services\DecisiveStatementService;
use App\Services\QuoteService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class SendQuoteJob implements ShouldQueue, ShouldBeUnique, ShouldBeUniqueUntilProcessing
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 5;

    /**
     * @param \App\Models\TelegramUser $telegramUser
     */
    public function __construct(private readonly TelegramUser $telegramUser) {}

    /**
     * @param QuoteService $quoteService
     * @return void
     */
    public function handle(QuoteService $quoteService, DecisiveStatementService $decisiveStatementService): void
    {
        (new SendQuoteAction($this->telegramUser))->execute($quoteService, $decisiveStatementService);
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
