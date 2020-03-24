<?php

namespace Modules\School\Entities;

use Modules\School\Entities\Group;
use Modules\School\Entities\Major;
use Modules\School\Entities\Room;
use Modules\School\Entities\School;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Modules\School\Transformers\ParticipantResource;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Participant extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $hidden = ['password'];

    public static function login($request)
    {
        $token = auth('participant')->attempt($request->only(['nisn', 'password'])) or abort(401, 'Unauthorized');
        return new ParticipantResource((object)self::responWithToken($token));
    }

    public static function responWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('participant')->factory()->getTTL() * 60 * 3,
            'user' => auth('participant')->user()
        ];
    }


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
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




