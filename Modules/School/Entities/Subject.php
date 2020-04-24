<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

    protected $hidden = ['group_id', 'school_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
