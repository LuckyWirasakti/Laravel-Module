<?php

namespace Modules\School\Http\Controllers;

use Modules\School\Http\Requests\SoalRequest;
use Illuminate\Support\Facades\Validator;
use Modules\School\Entities\Soal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SoalController extends Controller
{
    public function store(SoalRequest $request)
    {
        $kunci = $request->kunci;
        $jawaban = [
            'A' => [
                'teks' => $request->jawabanA,
                'kunci' => false,
            ],
            'B' => [
                'teks' => $request->jawabanB,
                'kunci' => false,
            ],
            'C' => [
                'teks' => $request->jawabanC,
                'kunci' => false,
            ],
            'D' => [
                'teks' => $request->jawabanD,
                'kunci' => false,
            ],
            'E' => [
                'teks' => $request->jawabanE,
                'kunci' => false,
            ],
        ];

        array_walk($jawaban, function(&$value, $key, $kunci){
            if($key == $kunci) {
                $value['kunci'] = true;
            }
        }, $kunci);

        $create = Soal::create([
            'id_subject' => $request->id_subject,
            'pertanyaan' => $request->pertanyaan,
            'pembahasan' => $request->pembahasan,
            'jawaban'    => json_encode($jawaban)
        ]);

        return response()->json([
            'message' => 'Soal Berhasil dibuat'
        ], 201);
    }

    public function getSubjectSoal(Request $request)
    {
        $validate = $request->validate([
            'id_subject' => 'required'
        ]);
        
        $db['soal'] = Soal::where('id_subject', intval($request->id_subject))
            ->select('id', 'pertanyaan', 'jawaban')
            ->get();

        foreach($db['soal'] as $soal){
            $pilihanFiltered = [];
            $pilihan = json_decode($soal->jawaban);

            foreach($pilihan as $key => $konten) {
                array_push($pilihanFiltered, [
                    'key' => $key,
                    'teks' => $konten->teks
                ]);
            }

            $soal->jawaban = $pilihanFiltered;
        }
        return response()->json($db['soal'], 200);
    }

}