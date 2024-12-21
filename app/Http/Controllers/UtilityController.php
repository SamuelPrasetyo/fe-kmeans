<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClusteringExport;

class UtilityController extends Controller
{
    public function listTahunAjar()
    {
        $query = "SELECT tahunajar as value, 
                    CONCAT(SUBSTR(tahunajar, 1, 4), ' / ', SUBSTR(tahunajar, 5, 4)) as label
                FROM nilaisiswa
                GROUP BY tahunajar";

        return DB::select($query);
    }

    public function listSemester()
    {
        $query = "SELECT distinct semester FROM nilaisiswa";

        return DB::select($query);
    }

    public function generateExcel()
    {
        // Ambil data dari session
        $clusteringResult = session('clustering_result');

        if (!$clusteringResult) {
            return back()->withErrors(['error' => 'Data clustering tidak ditemukan.']);
        }

        $data = $clusteringResult['data'];
        $clusters = $clusteringResult['clusters'];
        
        $fileName = 'hasil_clustering_' . $clusteringResult['algoritma'] . '_smt_' 
                . $clusteringResult['semester'] . '_thajar_' . $clusteringResult['tahunajar'] . '.xlsx';

        return Excel::download(new ClusteringExport($data, $clusters), $fileName);
    }
}
