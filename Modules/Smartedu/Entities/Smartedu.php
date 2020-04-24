<?php

namespace Modules\Smartedu\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Modules\Smartedu\Transformers\SmarteduResource;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Smartedu extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $hidden = ['password'];

    protected $username;

    public function username()
    {
        return $this->username;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function login($request)
    {
        $token = auth('api')->attempt($request->only(['username', 'password'])) or abort(401, 'Unauthorized');
        return new SmarteduResource((object)self::responWithToken($token));
    }

    public static function responWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 3,
            'user' => auth('api')->user()
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
