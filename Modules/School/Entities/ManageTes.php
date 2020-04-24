<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class ManageTes extends Model
{
    protected $table = 'manage_tes';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['group_id', 'school_id'];
    
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}