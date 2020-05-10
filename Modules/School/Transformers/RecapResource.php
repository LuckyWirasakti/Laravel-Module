<?php

namespace Modules\School\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class RecapResource extends Resource
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
            'user_nisn' => $this->participant->nisn,
            'user_name' => $this->participant->name,
            'exam_score' => $this->skor
        ];
    }
}
