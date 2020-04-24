<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\School\Entities\Group;
use Modules\School\Entities\Major;
use Modules\School\Entities\Master;
use Modules\School\Entities\Participant;
use Modules\School\Entities\Room;
use Modules\School\Entities\Subject;
use Modules\School\Jobs\MasterJob;
use Modules\School\Transformers\MasterResource;

class MasterController extends Controller
{
    public function index()
    {
        return MasterResource::collection(Master::with(['group', 'major'])->get());
    }

    public function store(Request $request)
    {
        MasterJob::dispatch($request->all());
        return response([
            'data' => [
                'group' => Group::whereYear('created_at', date('Y'))->count(),
                'major' => Major::whereYear('created_at', date('Y'))->count(),
                'room' => Room::whereYear('created_at', date('Y'))->count(),
                'participant' => Participant::whereYear('created_at', date('Y'))->count()
            ]
        ], 200);
    }
}
