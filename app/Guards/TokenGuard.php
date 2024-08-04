<?php

declare(strict_types=1);

namespace App\Guards;

use App\Models\Application;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;

class TokenGuard implements Guard
{
    protected $provider;

    /**
     * Instantiate the class.
     *
     * @param UserProvider $provider
     * @return void
     */
    public function __construct(UserProvider $provider)
    {
        $this->provider = $provider;
    }

    public function check(): bool
    {
        return !is_null($this->user());
    }

    public function guest()
    {
    }

    public function user(): ?Authenticatable
    {
        $header = request()->header('Authorization');
        if (Str::startsWith($header, 'Bearer ')) {
            $token = substr($header, 7);
            $application = Application::query()->where('token', $token)->first();
            if ($application) {
                return $application;
            }
            return null;
        }

        return null;
    }

    public function id()
    {
        return $this->user()->id;
    }

    public function validate(array $credentials = [])
    {
    }

    public function hasUser()
    {
    }

    public function setUser(Authenticatable $user)
    {
    }
}
