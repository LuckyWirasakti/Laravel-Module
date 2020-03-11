<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\School\Entities\Major;
use Modules\School\Http\Requests\MajorRequest;
use Modules\School\Transformers\MajorResource;

class MajorController extends Controller
{
    public function index()
    {
        return MajorResource::collection(Major::all());
    }

    public function update(Request $request, $id)
    {
        Major::where('id', $id)
        ->update([
            'name' => $request->name,
            'school_id' => auth('school')->id()
        ]);
        return MajorResource::collection(Major::all());
    }
}
