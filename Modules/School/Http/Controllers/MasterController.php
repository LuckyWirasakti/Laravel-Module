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
use Modules\School\Transformers\MasterResource;

class MasterController extends Controller
{
    public function index()
    {
        return MasterResource::collection(Master::with(['group', 'major'])->get());
    }

    public function store(Request $request)
    {
        $school_id = auth('school')->id();
        for ($i=0; $i < count($request['data']['major']); $i++) {
            $group_id = Group::firstOrCreate([
                'name' => $request["data"]['group'][$i],
                'school_id' => $school_id
            ])->id;

            $major_id = Major::firstOrCreate([
                'name' => $request["data"]['major'][$i],
                'school_id' => $school_id
            ])->id;

            $master_id = Master::firstOrCreate([
                'group_id' => $group_id,
                'major_id' => $major_id,
                'school_id' => $school_id
            ])->id;

            Room::firstOrCreate([
                'name' => $request["data"]['room'][$i],
                'master_id' => $master_id,
                'school_id' => $school_id
            ]);
        }

        foreach($request['data']['participant'] as $data){
            Participant::firstOrCreate([
                'name' => $data['name'],
                'nisn' => $data['nisn'],
                'password' => Hash::make($data['password']),
                'visible' => $data['visible'],
                'major_id' => Major::where('name', $data['major'])->first()->id,
                'room_id' => Room::where('name', $data['room'])->first()->id,
                'group_id' => Group::where('name', $data['group'])->first()->id,
                'school_id' => $school_id
            ]);
        }

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
