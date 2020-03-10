<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Level;
use Modules\Smartedu\Transformers\LevelResource;

class LevelController extends Controller
{
    public function index()
    {
        return LevelResource::collection(Level::all());
    }
}
