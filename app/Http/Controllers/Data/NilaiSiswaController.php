<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Http\Modules\MNilaiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NilaiSiswaModel;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        return view('nilai_siswa.NilaiSiswa', [
            'nilaisiswa' => DB::table('nilaisiswa')->paginate(10)
        ]);
    }

    public function delete()
    {
        NilaiSiswaModel::truncate();
        return redirect('/nilaisiswa')->with('success', 'Data Nilai Siswa Berhasil Dihapus');
    }

    public function filter(Request $request) {
        $tahunajar = $request->tahunajar;
        $semester = $request->semester;

        $modul = new MNilaiSiswa;
        $result = $modul->getListFilterNilaiSiswa($tahunajar, $semester);
        
        return view('nilai_siswa.FilterNilaiSiswa', compact('result'));
    }
}
