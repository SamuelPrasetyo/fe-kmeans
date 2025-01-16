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
use App\Http\Modules\MHasilPerbandingan;

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
            'jumlah_k' => 'sometimes',
            'eps' => 'sometimes',
            'min_pts' => 'sometimes',
            'algoritma' => 'required'
        ]);

        $algoritma = $request->input('algoritma');
        $tahunajar = json_decode($request->input('tahunajar'), true);
        $semester = json_decode($request->input('semester'), true);
        // Params K-Means
            $n_clusters = json_decode($request->input('jumlah_k'), true);
        // Params DBSCAN
            $eps = json_decode($request->input('eps'), true);
            $min_pts = json_decode($request->input('min_pts'), true);

        switch ($algoritma) {
            case 'elbow-method':
                $api_kmeans = new API_Kmeans;
                return $api_kmeans->elbowMethod($tahunajar, $semester);

            case 'kmeans':
                $api_kmeans = new API_Kmeans;
                return $api_kmeans->index($tahunajar, $semester, $n_clusters);

            case 'kdgraph':
                $api_dbscan = new API_dbscan;
                return $api_dbscan->kdistanceGraph($tahunajar, $semester);

            case 'dbscan':
                $api_dbscan = new API_dbscan;
                return $api_dbscan->index($tahunajar, $semester, $eps, $min_pts);

            case 'agglomerative':
                $api_agglomerative = new API_agglomerative;
                return $api_agglomerative->index($tahunajar, $semester);

            default:
                return back()->withErrors(['error' => 'Algoritma tidak valid!']);
        }
    }

    public function hasilPerbandingan()
    {
        $data = MHasilPerbandingan::getEvaluasiTerbaik();

        return view('HasilPerbandingan', [
            'nilaiEvaluasi' => $data['hasilTerbaik'],
            'jumlahEvaluasi' => $data['jumlahEvaluasi'],
            'jumlahKeseluruhan' => $data['jumlahKeseluruhan']
        ]);
    }
}
