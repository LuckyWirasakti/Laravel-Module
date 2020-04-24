<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
