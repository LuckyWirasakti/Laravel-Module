<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\School\Entities\Group;
use Modules\School\Entities\Major;

class ParticipantController extends Controller
{
    public function index()
    {
        return view('school::index');
    }

    public function store(Request $request)
    {


    }

    public function import(Request $request)
    {
        Group::create(
            array_merge(
                $request->all(),
                ['school_id' => auth('school')->id()]
            )
        );

        Major::create(
            array_merge(
                $request->all(),
                ['school_id' => auth('school')->id()]
            )
        );


    }

    public function destroy($id)
    {
        //
    }
}
