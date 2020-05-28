<?php

namespace Modules\School\Http\Controllers;

use Modules\Smartedu\Transformers\ParticipantResource;
use Illuminate\Routing\Controller;
use Modules\School\Entities\ManageTes;
use Modules\School\Entities\Participant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Hash;

class DashboardParticipantController extends Controller
{
    public function getMapel(Request $request)
    {
        $request->validate([
            'school_id' => 'required',
            'group_id' => 'required',
            'major_id' => 'required',
        ]);
        
        $getMapel = DB::table('manage_tes')
            ->join('subjects', 'manage_tes.subject_id', '=', 'subjects.id')
            ->select('manage_tes.id as id_manage_tes', 'manage_tes.status', 'subjects.id as id_subject', 'subjects.name as subject_name', 'manage_tes.date_implementation', 'manage_tes.hours_implementation')
            ->where([
                'manage_tes.school_id' => $request->school_id,
                'manage_tes.group_id' => $request->group_id,
                'manage_tes.major_id' => $request->major_id,
                ])
            ->get();
            
            $data = [];
            foreach($getMapel as $mapel){
                $response = [
                    'id_manage_tes' => $mapel->id_manage_tes,
                    'subject' => [],
                    'date_implemetation' => $mapel->date_implementation,
                    'hours_implementation' => $mapel->hours_implementation,
                    'status' => $mapel->status,
                ];
                $response['subject'] = [
                    'id_subject' => $mapel->id_subject,
                    'nama_subject' => $mapel->subject_name,
                ];

                array_push($data, $response);
            }

            return response()->json([$data]);

    }

    public function verifTokenMapel(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'id_manage_test' => 'required',
        ]);

        $token = ManageTes::where(['id' => $request->id_manage_test, 'token' => $request->token])->first();
        
        if($token){
            $response = [
                'status' => 'sukses',
                'message' => 'Token Benar',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => 'gagal',
                'message' => 'Token Anda Salah',
            ];
            return response()->json($response, 404);
        }
    }

    public function detailInformasi(Request $request)
    {
        $request->validate([
            'id_manage_tes' => 'required',
        ]);
        $id_user = auth('participant')->id();

        $data = [];
        $participant = Participant::where('id', $id_user)->first();
        $manage_tes = DB::table('manage_tes')
                        ->join('subjects', 'subjects.id', '=', 'manage_tes.subject_id')
                        ->where('manage_tes.id', $request->id_manage_tes)
                        ->first();

        $response = [
            'nama_peserta' => $participant->name,
            'nisn'  => $participant->nisn,
            'nama_subject'  => $manage_tes->name,
            'duration_work'  => $manage_tes->duration_work,
        ];

        return response()->json($response);
    }

    public function profile()
    {
        return ParticipantResource::collection(Participant::where('id', auth('participant')->id())->get());
    }

    public function update(Request $request)
    {
        $participant = Participant::where('id', auth('participant')->id())->first();

        if($participant)
        {
            if($request->hasFile('foto')){
                $destination_path = './uploads/profile/';
                $request->validate([
                    'foto' => 'required|mimes:jpg,jpeg,png|max:1048',
                ]);
        
                $namafoto = time().'.'.$request->foto->extension();
                $request->foto->move($destination_path, $namafoto);
            }else{
                $namafoto = $participant->foto;
            }
            $participant->update([
                'email' => $request->email,
                'phone' => $request->phone,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nama_orang_tua' => $request->nama_orang_tua,
                'phone_orang_tua' => $request->phone_orang_tua,
                'foto' => $namafoto,
            ]);
            return ParticipantResource::collection(Participant::where('id', auth('participant')->id())->get());
        }else{
            return response()->json(['message' => 'id Participant Tidak ada']);   
        }
    }
}
