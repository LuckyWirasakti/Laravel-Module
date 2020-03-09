<?php

namespace Modules\Smartedu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class School extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function store($request)
    {
        $school = School::create($request->all());
        $school->password = Hash::make($request);
        $school->save();
        $school->password = $request->password;
        return $school;
    }

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
