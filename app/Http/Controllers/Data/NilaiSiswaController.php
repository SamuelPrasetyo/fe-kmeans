<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        return view('nilai_siswa.NilaiSiswa', [
            'nilaisiswa' => DB::table('nilaisiswa')->paginate(20)
        ]);
    }
}
