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
use App\Http\Modules\API_Kmeans;
use App\Http\Modules\API_agglomerative;
use Svg\Tag\Rect;

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
            'tahunajar' => 'required',
            'semester' => 'required',
            'algoritma' => 'required'
        ]);

        $tahunajar = json_decode($request->input('tahunajar'), true);
        $semester = json_decode($request->input('semester'), true);
        $algoritma = $request->input('algoritma');

        switch ($algoritma) {
            case 'elbow-method':
                $api_kmeans = new API_Kmeans;
                return $api_kmeans->elbowMethod($tahunajar, $semester);

            case 'kmeans':
                $api_kmeans = new API_Kmeans;
                return $api_kmeans->index($tahunajar, $semester);

            case 'kdgraph':
                $api_dbscan = new API_dbscan;
                return $api_dbscan->kdistanceGraph($tahunajar, $semester);

            case 'dbscan':
                $api_dbscan = new API_dbscan;
                return $api_dbscan->index($tahunajar, $semester);

            case 'agglomerative':
                $api_agglomerative = new API_agglomerative;
                return $api_agglomerative->index($tahunajar, $semester);

            default:
                return back()->withErrors(['error' => 'Algoritma tidak valid!']);
        }
    }
}
