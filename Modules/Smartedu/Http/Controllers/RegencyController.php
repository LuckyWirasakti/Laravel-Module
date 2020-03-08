<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Regency;
use Modules\Smartedu\Transformers\RegencyResource;

class RegencyController extends Controller
{
    public function index()
    {
        return RegencyResource::collection(Regency::paginate(10));
    }
}
