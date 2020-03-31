<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ManageTesResource extends Resource
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
            'subject' => [
                'id' => $this->subject->id,
                'name' => $this->subject->name,
            ],
            'duration_work' => $this->duration_work,
            'hours_implementation' => $this->hours_implementation,
            'sync_date' => $this->sync_date,
            'date_implementation' => $this->date_implementation,
            'token' => $this->token,
            'day' => $this->day,
            'status' => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}

