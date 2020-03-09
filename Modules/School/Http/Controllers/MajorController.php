<?php

namespace Modules\School\Http\Controllers;

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

    public function store(MajorRequest $request)
    {
        Major::create(
            array_merge(
                $request->all(),
                ['school_id' => auth('school')->id()]
            )
        );
        return MajorResource::collection(Major::all());
    }

    public function destroy($id)
    {
        //
    }
}
