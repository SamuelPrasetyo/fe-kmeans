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

use App\Exports\NilaiExport;
use App\Http\Controllers\Controller;
use App\Imports\NilaiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ExcelController extends Controller
{
    public function import_excel(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Mengembalikan pesan error
                ->withInput(); // Mengembalikan input sebelumnya
        }

        try {
            $file = $request->file('file');
            $nama_file = rand() . $file->getClientOriginalName();
            $file->move('uploads', $nama_file);

            // Proses import data
            Excel::import(new NilaiImport(), public_path('/uploads/' . $nama_file));

            return redirect('nilaisiswa')->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage());
        }
    }

    public function export_excel()
    {
        return Excel::download(new NilaiExport, 'DataNilaiSiswaAll.xlsx');
    }
}
