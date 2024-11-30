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

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NilaiImport;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        return view('Dashboard');
    }

    public function formClustering()
    {
        return view('FormClustering');
    }
}
