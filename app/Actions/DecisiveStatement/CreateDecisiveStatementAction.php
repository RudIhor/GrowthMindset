<?php

namespace App\Actions\DecisiveStatement;

use App\DTOs\DecisiveStatement\StoreDecisiveStatementDTO;
use App\Models\DecisiveStatement;

class CreateDecisiveStatementAction
{
    /**
     * Creates a decisive statement.
     *
     * @param StoreDecisiveStatementDTO $decisiveStatementDTO
     * @return DecisiveStatement
     */
    public function execute(StoreDecisiveStatementDTO $decisiveStatementDTO): DecisiveStatement
    {
        return DecisiveStatement::query()->create($decisiveStatementDTO->toArray());
    }
}
