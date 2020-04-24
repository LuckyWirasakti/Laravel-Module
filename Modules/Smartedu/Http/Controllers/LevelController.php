<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Level;
use Modules\Smartedu\Http\Requests\LevelRequest;
use Modules\Smartedu\Transformers\LevelResource;

class LevelController extends Controller
{
    public function index()
    {
        return LevelResource::collection(Level::all());
    }

    public function update(LevelRequest $request, $id)
    {
        Level::find($id)->update(['name' => $request->name]);
        return $this->index();
    }
}
