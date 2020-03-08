<?php

namespace Modules\Smartedu\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class SmarteduResource extends Resource
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
            'user_photo' => $this->user->photo,
            'user_email' => $this->user->email,
            'user_role_id' => $this->user->role->id,
            'user_role_name' => $this->user->role->name,
            'user_created_at' => $this->user->created_at->diffForHumans(),
        ];
    }
}
