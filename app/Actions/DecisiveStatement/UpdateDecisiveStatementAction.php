<?php

namespace App\Actions\DecisiveStatement;

use App\DTOs\DecisiveStatement\UpdateDecisiveStatementDTO;
use App\Models\DecisiveStatement;

class UpdateDecisiveStatementAction
{
    /**
     * Updates a decisive statement.
     *
     * @param UpdateDecisiveStatementDTO $decisiveStatementDTO
     * @param DecisiveStatement $decisiveStatement
     * @return DecisiveStatement
     */
    public function execute(UpdateDecisiveStatementDTO $decisiveStatementDTO, DecisiveStatement $decisiveStatement): DecisiveStatement
    {
        $decisiveStatement->update(array_filter($decisiveStatementDTO->toArray()));

        return $decisiveStatement;
    }
}
