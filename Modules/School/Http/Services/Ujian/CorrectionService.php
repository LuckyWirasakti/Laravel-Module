<?php

namespace Modules\School\Http\Services\Ujian;

use Illuminate\Support\Facades\DB;
use Modules\School\Entities\UjianJawaban;

class CorrectionService
{
    public function calculate(UjianJawaban $ujianJawaban)
    {
        if ($ujianJawaban == null) {
            return [
                'success' => false,
                'code' => 400,
                'message' => 'Object harus UjianJawaban atau turunannya.'
            ];
        }
        
        $result = [
            'summary' => [
                'total_soal' => 0,
                'dijawab' => 0,
                'tidak_dijawab' => 0,
                'benar' => 0,
                'salah' => 0
            ],
            'detail' => []
        ];
        
        $data['kunci_jawaban'] = [];
        $data['jawaban_peserta'] = json_decode($ujianJawaban->jawaban, true);

        // CHECK: Validitas format jawaban
        if ($data['jawaban_peserta'] == null && json_last_error() != JSON_ERROR_NONE) {
            return [
                'success' => false,
                'code' => 400,
                'message' => 'Payload jawaban tidak valid. Pastikan payload dalam bentuk JSON string.'
            ];
        }
        
        $db['soal_kunci'] = DB::table('soal')
            ->where('id_subject', $ujianJawaban->subject_id)
            ->select('id as id_soal', 'jawaban as pilihan_jawaban')    
            ->get();

        // CHECK: Kelengkapan bank soal (data kunci jawaban)
        if (count($db['soal_kunci']) == 0) {
            return [
                'success' => false,
                'code' => 500,
                'message' => 'Gagal melakukan koreksi karena data dalam bank soal tidak lengkap.'
            ];
        }

        foreach ($db['soal_kunci'] as $kunci) {
            $pilihanJawaban = json_decode($kunci->pilihan_jawaban, true);
            $kunciJawaban = [
                'id_soal' => $kunci->id_soal,
                'jawaban' => array_filter($pilihanJawaban, function($jawaban) {
                    return ($jawaban['kunci'] == true);
                })
            ];
            array_push($data['kunci_jawaban'], $kunciJawaban);
        }

        foreach ($data['jawaban_peserta'] as $jawaban) {
            ++$result['summary']['dijawab'];

            foreach ($data['kunci_jawaban'] as $kunci) {
                if ($jawaban['id_soal'] == $kunci['id_soal']) {
                    $koreksi = [
                        'id_soal' => $jawaban['id_soal'],
                        'pilihan' => $jawaban['pilihan'],
                        'benar' => false,
                    ];

                    if ($jawaban['pilihan'] == array_keys($kunci['jawaban'])[0]) {
                        $koreksi['benar'] = true;
                        ++$result['summary']['benar'];
                    } else {
                        ++$result['summary']['salah'];
                    }

                    array_push($result['detail'], $koreksi);
                }
            }
        }

        // CHECK: untuk ketidak sesuaian ID soal dengan kunci
        if (count($result['detail']) == 0) {
            // return [
            //     'success' => false,
            //     'code' => 400,
            //     'message' => 'Jawaban tidak dapat dikoreksi. Pastikan yang disubmit sudah sesuai dengan Kategori Submateri-nya.'
            // ];
        }
        
        $result['summary']['total_soal'] = count($data['kunci_jawaban']);
        $result['summary']['tidak_dijawab'] = $result['summary']['total_soal']-$result['summary']['dijawab'];

        return [
            'success' => true,
            'code' => 200,
            'result' => $result
        ];
    }
}