<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Smartedu;
use Modules\Smartedu\Http\Requests\SmarteduRequest;

class SmarteduController extends Controller
{
    public function login(SmarteduRequest $request)
    {
        return Smartedu::login($request);
    }
}
