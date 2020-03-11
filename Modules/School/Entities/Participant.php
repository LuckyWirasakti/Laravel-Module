<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = ['password'];
}
