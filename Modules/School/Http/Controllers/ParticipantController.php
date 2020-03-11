<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\School\Entities\Participant;
use Modules\Smartedu\Transformers\ParticipantResource;

class ParticipantController extends Controller
{
    public function index()
    {
        return ParticipantResource::collection(Participant::with(['group','major','room'])->where('school_id', auth('school')->id())->get());
    }
}
