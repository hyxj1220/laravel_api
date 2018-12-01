<?php

namespace App\Providers;

use Illuminate\Support\Str;
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
     public $auth_user_session = [
        'uid','airport_iata','mobile','salt','password',
        'department_1','department_2','department_3',
        'app_id', 'ustatus','created_at', 'expiry_date','remember_token'
    ];

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return md5($user->getAuthSalt() . $credentials['password']) == $user->getAuthPassword();
    }


    /**
    基于自己的业务逻辑重写
    */
    public function retrieveById($identifier)
    {
        $user_auth = session('user_auth');
        if ($user_auth && $this->is_expired($user_auth)){
            return $user_auth;
        }
        $model = $this->createModel();

        $user_auth = $model->newQuery()
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first($this->auth_user_session);

        return $this->is_expired($user_auth);
    }

    public function retrieveByToken($identifier, $token)
    {
        $model = $this->createModel();

        $model = $this->is_expired($model->where($model->getAuthIdentifierName(), $identifier)->first($this->auth_user_session));

        if (! $model) {
            return null;
        }

        $rememberToken = $model->getRememberToken();

        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }


    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();
        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $this->is_expired($query->first($this->auth_user_session));
    }

    public function is_expired($user){
        if (empty($user)){
            return null;
        }
        if ($user->ustatus == 0){
            return null;

        }
        if ($user->expiry_date >= time() || $user->expiry_date == 0){
            return $user;
        }
        return null;
    }
}
