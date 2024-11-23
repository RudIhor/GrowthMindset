<?php

namespace Modules\Author\app\DTOs\Requests;

use Spatie\LaravelData\Data;

class AuthorRequestDTO extends Data
{
    public function __construct(public ?string $first_name, public ?string $last_name)
    {
    }
}
