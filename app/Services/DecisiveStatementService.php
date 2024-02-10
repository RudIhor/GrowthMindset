<?php

namespace App\Services;

use App\Azure\Services\TranslatorService;
use App\DTOs\DecisiveStatement\StoreDecisiveStatementDTO;
use App\Models\DecisiveStatement;
use Illuminate\Support\Str;
use Spatie\LaravelData\PaginatedDataCollection;

class DecisiveStatementService
{
    public function __construct(private readonly TranslatorService $translatorService) {}

    /**
     * @return string
     */
    public function getRandomDecisiveStatement(string $languageCode): string
    {
        /** @var DecisiveStatement $decisiveStatement */
        $decisiveStatement = DecisiveStatement::query()->inRandomOrder()->first();
        $text = Str::wrap($decisiveStatement->content, '*') . "\n\n" . view('decisive-statements.sugar-list')->render();

        return $this->translatorService->translate($text, $languageCode);
    }

    /**
     * @return PaginatedDataCollection
     */
    public function getDecisiveStatements(): PaginatedDataCollection
    {
        return StoreDecisiveStatementDTO::collection(DecisiveStatement::query()->paginate(25));
    }

    /**
     * @param DecisiveStatement $decisiveStatement
     * @return StoreDecisiveStatementDTO
     */
    public function getDecisiveStatement(DecisiveStatement $decisiveStatement): StoreDecisiveStatementDTO
    {
        return StoreDecisiveStatementDTO::from($decisiveStatement);
    }
}
