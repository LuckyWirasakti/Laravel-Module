<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\School\Entities\Major;
use Modules\School\Entities\Master;
use Modules\School\Transformers\MajorResource;
use Modules\School\Transformers\MasterResource;

class MajorController extends Controller
{
    public function index()
    {
        return MasterResource::collection(Master::where('school_id',auth('school')->id())->with(['group', 'major'])->get());
    }

    public function showAll()
    {
        MajorResource::collection(Major::where('school_id', auth('school')->id())->get());
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
