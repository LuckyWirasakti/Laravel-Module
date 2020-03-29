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
        if ($request->hari) {
            return ManageTesResource::collection(ManageTes::where(['day', $request->hari,'school_id',auth('school')->id()])->with(['major', 'group'])->get());
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
        $manageTes = ManageTes::find($id);
        if ($manageTes) {
            $request->validate([
                "group_id" => 'required',
                "major_id" => 'required',
                "subject_id" => 'required',
                "duration_work" => 'required',
                "hours_implementation" => 'required',
                "sync_date" => 'required',
                "date_implementation" => 'required',
                "day" => 'required',
            ]);
            $result =  $manageTes->update([
                "group_id" => $request->group_id,
                "major_id" => $request->major_id,
                "subject_id" => $request->subject_id,
                "duration_work" => $request->duration_work,
                "hours_implementation" => $request->hours_implementation,
                "sync_date" => $request->sync_date,
                "date_implementation" => $request->date_implementation,
                "day" => $request->day,
            ]);

            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data berhasil di ubah',
                ];
                return response()->json($response);
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Data gagal diubah',
                ];
                return response()->json($response);
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Data tidak ditemukan',
            ];
            return response()->json($response);
        }
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
