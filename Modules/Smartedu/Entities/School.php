<?php

namespace Modules\Smartedu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class School extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function store($request)
    {
        $school = School::create(
            array_merge(
                $request->all(),
                ['visible' => $request->password]
            )
        );

        $school->password = Hash::make($request->password);
        $school->save();
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
