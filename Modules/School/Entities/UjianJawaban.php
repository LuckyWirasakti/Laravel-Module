<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class UjianJawaban extends Model
{
    protected $table = 'ujian_jawaban';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
