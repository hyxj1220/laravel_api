<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'own_user';
    protected $primaryKey = 'uid';
    
    // 自定义remember_me字段
    // protected $rememberTokenName = 'remember_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'salt',
    ];


    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getAuthSalt()
    {
        return $this->attributes['salt'];
    }
}
