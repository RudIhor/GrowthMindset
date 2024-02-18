<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class StoreLoginDTO extends Data
{
    public string $email;
    public string $password;

    /**
     * @return array<string, string[]>
     */
    public static function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
