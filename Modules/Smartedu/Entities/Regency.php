<?php

namespace Modules\Smartedu\Entities;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $fillable = ['name', 'province_id'];
}
