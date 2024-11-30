<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NilaiSiswa;

class FileNilaiController extends Controller
{
    public function index()
    {
        return view('file_nilai.View');
    }


}
