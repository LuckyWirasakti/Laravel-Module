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
        // $sekolah = 
        // $user = [

        // ];

        return [
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in,
            'id' => $this->user->id,
            'name' => $this->user->name,
            'nisn' => $this->user->nisn,
            'id_kelas' => $this->user->province->name,
            'id_jurusan' => $this->user->regency->name,
            'id_room' => $this->user->level->name,
            'id_sekolah' => $this->user->level->name,
            'user_created_at' => $this->user->created_at->diffForHumans(),
        ];
    }
}
