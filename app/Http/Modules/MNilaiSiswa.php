<?php

namespace App\Http\Modules;

use Illuminate\Support\Facades\DB;

class MNilaiSiswa
{
    public function getListFilterNilaiSiswa($tahunajar, $semester)
    {
        $query = "SELECT semester, tahunajar, nis, kelas, nama_siswa,
                    nagama, npkn, nbindo, nmatematika, nipa, nips, 
                    nbinggris, nsenibudaya, npjok, nprakarya, ntik
                FROM nilaisiswa
                WHERE tahunajar = :thajar and semester = :smt";

        $result = DB::select($query, [
            'thajar' => $tahunajar,
            'smt' => $semester
        ]);

        if (empty($result)) {
            dd('KOSONG');
        }

        return $result;
    }
}
