<?php

namespace Modules\School\Http\Controllers;

use Modules\Smartedu\Transformers\ParticipantResource;
use Modules\School\Http\Requests\ParticipantRequest;
use Modules\School\Entities\Participant;
use Illuminate\Routing\Controller;

class ParticipantController extends Controller
{
    public function index()
    {
        return ParticipantResource::collection(Participant::with(['group','major','room'])->where('school_id', auth('school')->id())->get());
    }

    public function Login(ParticipantRequest $request)
    {
        return Participant::login($request);
    }
}
