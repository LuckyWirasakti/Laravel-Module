<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

    protected $hidden = ['group_id', 'school_id'];
    protected $fillable = [];
}
