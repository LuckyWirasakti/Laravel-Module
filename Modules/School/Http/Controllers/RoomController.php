<?php

namespace Modules\School\Http\Controllers;

use Illuminate\Http\Request;
use Modules\School\Entities\Room;
use Illuminate\Routing\Controller;
use Modules\School\Transformers\RoomResource;

class RoomController extends Controller
{
    public function index($id)
    {
        return RoomResource::collection(
            Room::where('school_id',$id)->with([
                'master'=> function($query){
                    $query->with([
                        'group',
                        'major'
                    ]);
                }
            ])->get()
        );
    }
}
