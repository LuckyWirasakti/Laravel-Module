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

    // fungsi soal untuk user ujian
    // Tampil Pertanyaan dan semua Jawaban A, B, C, D (kunci jawaban tidak di tampilkan)
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

    // fungsi get soal untuk admin, untuk cek soal
    // Tampil Pertanyaan, Pembahasan dan Kunci Jawaban
    public function getSoal(Request $request)
    {
        $validate = $request->validate([
            'id_subject' => 'required'
        ]);
        
        $db['soal'] = Soal::where('id_subject', intval($request->id_subject))
            ->select('id', 'pertanyaan', 'jawaban', 'pembahasan')
            ->get();

        foreach($db['soal'] as $soal){
            $pilihanFiltered = [];
            $pilihanJawaban = [];
            $pilihan = json_decode($soal->jawaban);

            foreach($pilihan as $key => $konten) {
                if($konten->kunci == true){
                
                    array_push($pilihanFiltered, [
                        'kunci' => $key,
                    ]);
                }
                array_push($pilihanJawaban, [
                    'key' => $key,
                    'teks' => $konten->teks
                ]); 
            }

            $soal->pilihanjawaban = $pilihanJawaban;  
            $soal->jawaban = $pilihanFiltered;  
        }
        return response()->json($db['soal'], 200);
    }

    public function fileUpload(Request $request)
    {
        if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
            //get extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/soal', $filenametostore);
            
            $link = asset('storage/soal/'.$filenametostore);
            return '<script type="e7b932ac4e96db3366f43b17-text/javascript">window.parent.CKEDITOR.tools.callFunction(1, '.$link.', "Image successfully uploaded"/)</script><script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="e7b932ac4e96db3366f43b17-|49" defer=""></script>';
        }
    }

    public function submit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            
        ]);
    }

}
