<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Regency;
use Modules\Smartedu\Transformers\RegencyResource;

class RegencyController extends Controller
{
    public function index($province_id)
    {
        return RegencyResource::collection(Regency::where('province_id', $province_id)->get());
    }
}
