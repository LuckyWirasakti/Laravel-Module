<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['password'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
