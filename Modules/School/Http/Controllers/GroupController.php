<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Http\Request;
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

    public function update(Request $request, $id)
    {
        Group::where('id', $id)
        ->update([
            'name' => $request->name,
            'school_id' => auth('school')->id()
        ]);

        return GroupResource::collection(Group::all());
    }
}
