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
            'group' => $this->group->name,
            'major' => $this->major->name,
            'room' => $this->room->name,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
