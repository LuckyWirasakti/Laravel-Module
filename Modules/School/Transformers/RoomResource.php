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
            'master_id' => $this->master->id,
            'major' => [
                'id' => $this->master->major->id,
                'name' => $this->master->major->name
            ],
            'group' => [
                'id' => $this->master->group->id,
                'name' => $this->master->group->name
            ],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
