<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }
}
