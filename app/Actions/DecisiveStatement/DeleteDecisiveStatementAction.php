<?php

namespace App\Actions\DecisiveStatement;

use App\Models\DecisiveStatement;

class DeleteDecisiveStatementAction
{
    /**
     * Deletes a decisive statement.
     *
     * @param DecisiveStatement $decisiveStatement
     * @return bool|null
     */
    public function execute(DecisiveStatement $decisiveStatement): ?bool
    {
        return $decisiveStatement->delete();
    }
}
