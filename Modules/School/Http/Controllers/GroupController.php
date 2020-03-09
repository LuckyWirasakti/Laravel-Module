<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\School\Entities\Group;
use Modules\School\Http\Requests\GroupRequest;
use Modules\School\Transformers\GroupResource;

class GroupController extends Controller
{
    public function index()
    {
        return GroupResource::collection(Group::all());
    }

    public function store(GroupRequest $request)
    {
        Group::create(
            array_merge(
                $request->all(),
                ['school_id' => auth('school')->id()]
            )
        );
        return GroupResource::collection(Group::all());
    }

    public function destroy($id)
    {
        //
    }
}
