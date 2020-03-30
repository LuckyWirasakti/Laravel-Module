<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class SubjectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'score' => $this->score,
            'school' => [
                'id' => $this->school->id,
                'name' => $this->school->name,
            ],
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
