<?php

namespace Modules\School\Entities;

use Modules\School\Entities\Level;
use Modules\School\Entities\Regency;
use Modules\School\Entities\Province;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Modules\School\Transformers\SchoolResource;
use Illuminate\Foundation\Auth\User as Authenticatable;

class School extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $hidden = ['password'];

    protected $username;

    public function username()
    {
        return $this->username;
    }

    public static function login($request)
    {
        $token = auth('school')->attempt($request->only(['username', 'password'])) or abort(401, 'Unauthorized');
        return new SchoolResource((object)self::responWithToken($token));
    }

    public static function responWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('school')->factory()->getTTL() * 60 * 3,
            'user' => auth('school')->user()
        ];
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
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
