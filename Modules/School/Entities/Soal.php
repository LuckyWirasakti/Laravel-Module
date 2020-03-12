<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $guarded = ['id','created_at','updated_at'];
}
