<?php

namespace Modules\Smartedu\Entities;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
