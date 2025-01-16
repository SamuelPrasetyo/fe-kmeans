<?php

namespace App\Http\Modules;

use Illuminate\Support\Facades\DB;

class MHasilPerbandingan
{
    public static function getEvaluasiTerbaik()
    {
        // Ambil semua data dari tabel nilaievaluasi
        $data = DB::table('nilaievaluasi')->get();

        // Kelompokkan data berdasarkan Tahun Ajar dan Semester
        $groupedData = $data->groupBy(['tahunajar', 'semester']);

        $hasilTerbaik = [];

        $jumlahEvaluasi = [
            'k-means' => ['chi' => 0, 'dbi' => 0, 'ss' => 0],
            'dbscan' => ['chi' => 0, 'dbi' => 0, 'ss' => 0],
            'agglomerative' => ['chi' => 0, 'dbi' => 0, 'ss' => 0],
        ];

        foreach ($groupedData as $tahunajar => $semesters) {
            foreach ($semesters as $semester => $records) {
                // Temukan nilai terbaik untuk setiap metrik
                $bestChi = $records->max('chi');
                $bestDbi = $records->min('dbi');
                $bestSs = $records->max('ss');

                // Tandai nilai terbaik
                $records->each(function ($record) use ($bestChi, $bestDbi, $bestSs, &$jumlahEvaluasi) {
                    $record->is_best_chi = $record->chi == $bestChi;
                    $record->is_best_dbi = $record->dbi == $bestDbi;
                    $record->is_best_ss = $record->ss == $bestSs;

                    // Tambahkan ke jumlah evaluasi jika nilai adalah terbaik
                    if ($record->is_best_chi) {
                        $jumlahEvaluasi[strtolower($record->algoritma)]['chi']++;
                    }
                    if ($record->is_best_dbi) {
                        $jumlahEvaluasi[strtolower($record->algoritma)]['dbi']++;
                    }
                    if ($record->is_best_ss) {
                        $jumlahEvaluasi[strtolower($record->algoritma)]['ss']++;
                    }
                });

                $hasilTerbaik[$tahunajar][$semester] = $records;
            }
        }

        // Hitung total keseluruhan per algoritma
        $jumlahKeseluruhan = array_map(function ($values) {
            return array_sum($values);
        }, $jumlahEvaluasi);

        return [
            'hasilTerbaik' => $hasilTerbaik,
            'jumlahEvaluasi' => $jumlahEvaluasi,
            'jumlahKeseluruhan' => $jumlahKeseluruhan,
        ];
    }
}
