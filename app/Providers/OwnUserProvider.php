<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as Authenticatable;

class OwnUserProvider extends EloquentUserProvider
{
     /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return md5($user->getAuthSalt() . $credentials['password']) == $user->getAuthPassword();
    }
}
