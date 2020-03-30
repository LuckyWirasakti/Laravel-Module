<?php

namespace Modules\Smartedu\Transformers;

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

        return [
            'id' => $this->id,
            'name' => $this->name,
            'nisn' => $this->nisn,
            'password' => $this->visible,
            'group' => [
                'id' => $this->group->id,
                'name' => $this->group->name
            ],
            'major' => [
                'id' => $this->major->id,
                'name' => $this->major->name
            ],
            'room' => [
                'id' => $this->room->id,
                'name' => $this->room->name
            ],
            'school' => [
                'id' => $this->school->id,
                'name' => $this->school->name
            ],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}