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
            'school' => $this->school->name,
            'group' => $this->group->name,
            'major' => $this->group->name,
            'subject' => $this->subject->name,
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

