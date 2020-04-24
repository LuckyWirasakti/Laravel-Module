<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

    protected $hidden = ['school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
