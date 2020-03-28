<?php

namespace Modules\School\Http\Controllers;

use Modules\School\Http\Requests\ManageTesRequest;
use Illuminate\Routing\Controller;
use Modules\School\Entities\ManageTes;
use Modules\School\Transformers\ManageTesResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ManageTesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->hari) {
            return ManageTesResource::collection(ManageTes::where('day', $request->hari)->with(['major', 'group'])->get());
        }
            return ManageTesResource::collection(ManageTes::with(['major', 'group'])->get());
    }

    public function store(ManageTesRequest $request)
    {
        $pool = '123456789ABCDEFGHJKLMNPRSTUVWXYZ';
        $passRand = substr(str_shuffle(str_repeat($pool, 5)), 0, 6);

        $manageTes = ManageTes::create(
            array_merge(
                $request->all(),
                [
                    'school_id' => auth('school')->id(),
                    'token' => $passRand,
                    'day' => $request->day
                ]
            )
        );
        $response = [
            'status' => 'success',
            'message' => 'Data berhasil dibuat',
            'data' => $manageTes
        ];
        return response()->json($response);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $manageTes = ManageTes::find($id);
        if ($manageTes) {
            $manageTes->delete();
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Data gagal dihapus',
            ];
            return response()->json($response);
        }

    }
}
