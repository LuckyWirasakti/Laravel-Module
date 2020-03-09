<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class SchoolResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_username' => $this->user->username,
            'user_province' => $this->user->province->name,
            'user_regency' => $this->user->regency->name,
            'user_level' => $this->user->level->name,
            'user_created_at' => $this->user->created_at->diffForHumans(),
        ];
    }
}
