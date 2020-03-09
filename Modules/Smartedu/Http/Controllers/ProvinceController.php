<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Province;
use Modules\Smartedu\Transformers\ProvinceResource;

class ProvinceController extends Controller
{
    public function index()
    {
        return ProvinceResource::collection(Province::all());
    }
}
