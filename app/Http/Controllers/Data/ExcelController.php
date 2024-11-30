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
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiImport;
use App\Models\NilaiSiswa;
use Illuminate\Support\Facades\Session;

class ExcelController extends Controller
{
    public function import_excel(Request $request)
    {
        // Validation
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // Get File
        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('uploads', $nama_file);

        // Import data
        Excel::import(new NilaiImport, public_path('/uploads/' . $nama_file));

        Session::flash('Success', 'Data Imported Successfully');

        return redirect('data');
    }

    public function export_excel()
    {
        return Excel::download(new NilaiSiswa(), 'NilaiSiswa.xlsx');
    }
}
