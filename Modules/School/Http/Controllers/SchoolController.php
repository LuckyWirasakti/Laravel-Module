<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\School\Entities\School;
use Modules\School\Http\Requests\SchoolRequest;

class SchoolController extends Controller
{
    public function Login(SchoolRequest $request)
    {
        return School::login($request);
    }

}
