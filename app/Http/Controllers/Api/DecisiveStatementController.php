<?php

namespace App\Http\Controllers\Api;

use App\Actions\DecisiveStatement\{CreateDecisiveStatementAction,
    DeleteDecisiveStatementAction,
    UpdateDecisiveStatementAction};
use App\DTOs\DecisiveStatement\{StoreDecisiveStatementDTO, UpdateDecisiveStatementDTO};
use App\Http\Controllers\Controller;
use App\Models\DecisiveStatement;
use App\Services\DecisiveStatementService;
use Spatie\LaravelData\PaginatedDataCollection;

class DecisiveStatementController extends Controller
{
    public function __construct(private readonly DecisiveStatementService $decisiveStatementService)
    {
    }

    /**
     * @return PaginatedDataCollection
     */
    public function index(): PaginatedDataCollection
    {
        return $this->decisiveStatementService->getDecisiveStatements();
    }

    /**
     * @param DecisiveStatement $decisiveStatement
     * @return StoreDecisiveStatementDTO
     */
    public function show(DecisiveStatement $decisiveStatement): StoreDecisiveStatementDTO
    {
        return $this->decisiveStatementService->getDecisiveStatement($decisiveStatement);
    }

    /**
     * @param StoreDecisiveStatementDTO $decisiveStatementDTO
     * @param CreateDecisiveStatementAction $createDecisiveStatementAction
     * @return DecisiveStatement
     */
    public function store(
        StoreDecisiveStatementDTO $decisiveStatementDTO,
        CreateDecisiveStatementAction $createDecisiveStatementAction
    ): DecisiveStatement {
        return $createDecisiveStatementAction->execute($decisiveStatementDTO);
    }

    /**
     * @param DecisiveStatement $decisiveStatement
     * @param UpdateDecisiveStatementDTO $decisiveStatementDTO
     * @param UpdateDecisiveStatementAction $updateDecisiveStatementAction
     * @return DecisiveStatement
     */
    public function update(
        DecisiveStatement $decisiveStatement,
        UpdateDecisiveStatementDTO $decisiveStatementDTO,
        UpdateDecisiveStatementAction $updateDecisiveStatementAction
    ): DecisiveStatement {
        return $updateDecisiveStatementAction->execute($decisiveStatementDTO, $decisiveStatement);
    }

    /**
     * @param DecisiveStatement $decisiveStatement
     * @param DeleteDecisiveStatementAction $deleteDecisiveStatementAction
     * @return bool|null
     */
    public function destroy(
        DecisiveStatement $decisiveStatement,
        DeleteDecisiveStatementAction $deleteDecisiveStatementAction
    ): ?bool {
        return $deleteDecisiveStatementAction->execute($decisiveStatement);
    }
}
