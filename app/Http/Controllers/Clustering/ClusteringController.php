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

namespace App\Http\Controllers\Clustering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NilaiSiswa;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Clustering\KMeansController;

class ClusteringController extends Controller
{
    protected $kMeans;

    public function __construct(KMeansController $kMeans)
    {
        $this->kMeans = $kMeans;
    }
 
    public function clusterNilaiSiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'k' => ['required', 'integer', 
                function ($attribute, $value, $fail)
                {
                    if ($value % 2 == 0) {
                        $fail('Nilai dari K harus merupakan angka ganjil');
                    }    
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect('/clustering/form')->withErrors($validator)->withInput();
        }

        $data = NilaiSiswa::all(['nis', 'nama_siswa', 'nmatematika', 'nbinggris', 'nbindo', 'nipa'])->toArray();
        
        /*** 
         * ! Note : Nilai dari K usahakan di input di form
         */
        $k = $request->input('k', 3);

        list($centroids, $clusters) = $this->kMeans->kmeans($data, $k);

        // Menyimpan hasil klaster ke dalam database
        foreach ($data as $key => $nilai) {
            $nilaiSiswa = NilaiSiswa::where('nis', $nilai['nis'])->first();
            if ($nilaiSiswa) {
                $nilaiSiswa->cluster = $clusters[$key];
                $nilaiSiswa->save();    
            }
        }

        $data = NilaiSiswa::all(['nis', 'nama_siswa', 'nmatematika', 'nbinggris', 'nbindo', 'nipa', 'cluster'])->toArray();

        /* ATAU */

        // Menambahkan informasi cluster ke dalam Nilai Siswa
        // foreach ($data as $key => $nilai) {
        //     $data[$key]['cluster'] = $clusters[$key];
        // }

        return view('HasilClustering', compact('data', 'centroids'));
    }



}