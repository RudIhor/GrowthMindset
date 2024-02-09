<?php

namespace App\DTOs\Auth;

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
            'email' => ['required', 'string', 'email', 'unique:users, email'],
            'password' => ['required', 'string'],
        ];
    }
}
