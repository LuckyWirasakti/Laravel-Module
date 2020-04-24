<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class RoomResource extends Resource
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
            'major' => [
                'id' => $this->major->id,
                'name' => $this->major->name
            ],
            'group' => [
                'id' => $this->major->group->id,
                'name' => $this->major->group->name
            ],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
