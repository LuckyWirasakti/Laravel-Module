<?php

namespace Modules\Smartedu\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Smartedu\Entities\Province;
use Modules\Smartedu\Http\Requests\ProvinceRequest;
use Modules\Smartedu\Transformers\ProvinceResource;

class ProvinceController extends Controller
{
    public function index()
    {
        return ProvinceResource::collection(Province::all());
    }

    public function update(ProvinceRequest $request, $id)
    {
        Province::find($id)->update(['name' => $request->name]);
        return $this->index();
    }
}
