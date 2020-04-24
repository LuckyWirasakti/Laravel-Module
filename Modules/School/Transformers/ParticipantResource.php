<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ParticipantResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        $datanya = [
                'group' => [
                    'id' => $this->user->group->id,
                    'name' => $this->user->group->name
                ],
                'major' => [
                    'id' => $this->user->major->id,
                    'name' => $this->user->major->name
                ],
                'room' => [
                    'id' => $this->user->room->id,
                    'name' => $this->user->room->name
                ],
                'school' => [
                    'id' => $this->user->school->id,
                    'name' => $this->user->school->name
                ],
            ];

            array_push($data, $datanya);

        return [
            'access_token' => $this->access_token,
            'token_type' => $this->token_type,
            'expires_in' => $this->expires_in,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_nisn' => $this->user->nisn,
            'data' => $data,
            'user_created_at' => $this->user->created_at->diffForHumans(),
        ];
    }
}
