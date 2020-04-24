<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class MasterResource extends Resource
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
            'group' => [
                'id' => $this->group->id,
                'name' => $this->group->name,
            ],
            'major' => [
                'id' => $this->major->id,
                'name' => $this->major->name,
            ],
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
