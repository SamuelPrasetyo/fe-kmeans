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

use App\Http\Modules\API_dbscan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Modules\API_Kmeans;

class MainController extends Controller
{
    public function index()
    {
        return view('Dashboard');
    }

    public function formClustering()
    {
        $utils = new UtilityController;
        $tahunajar = $utils->listTahunAjar();
        $semester = $utils->listSemester();

        return view('FormClustering', compact('tahunajar', 'semester'));
    }

    public function processClustering(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        $algoritma = $request->input('algoritma');

        switch ($algoritma) {
            case 'kmeans':
                $api_kmeans = new API_Kmeans;
                return $api_kmeans->index($file);
            
            case 'dbscan':
                $api_dbscan = new API_dbscan;
                return $api_dbscan->index($file);
            
            // case 'meanshift':
            //     # code...
            //     break;

            default:
                return back()->withErrors(['error' => 'Algoritma tidak valid!']);
        }
    }
}
