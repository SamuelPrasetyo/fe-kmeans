<?php

/***
 **   ███████  █████  ███    ███ ██    ██ ███████ ██      
 **   ██      ██   ██ ████  ████ ██    ██ ██      ██      
 **   ███████ ███████ ██ ████ ██ ██    ██ █████   ██      
 **        ██ ██   ██ ██  ██  ██ ██    ██ ██      ██      
 **   ███████ ██   ██ ██      ██  ██████  ███████ ███████ 
 *                                                       
 *? Author : SAMUEL PRASETYO
 *! Quotes : "Tetaplah berjuang untuk mencapai kesuksesanmu. 
 *!           Jangan mengandalkan orang lain, karena setiap 
 *!           langkah yang kamu ambil dan setiap usaha yang 
 *!           kamu lakukan adalah hasil kerja kerasmu sendiri."
 */

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Imports\NilaiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NilaiSiswaModel;
use Illuminate\Support\Facades\Session;

class ExcelController extends Controller
{
    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->move('uploads', $nama_file);

        Excel::import(new NilaiImport(), public_path('/uploads/'.$nama_file));

        Session::flash('success', 'Data berhasil diimport!');

        return redirect('nilaisiswa');
    }

    public function export_excel()
    {
        return Excel::download(new NilaiSiswaModel(), 'NilaiSiswaModel.xlsx');
    }
}
