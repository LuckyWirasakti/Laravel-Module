<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

    protected $hidden = ['school_id'];
	
	public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
