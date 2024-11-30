<?php

namespace App\Http\Controllers\Clustering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class API_Kmeans extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);
    
        $file = $request->file('file');
        
        try {
            // Kirim file ke API
            $response = Http::attach(
                'file', 
                file_get_contents($file->getRealPath()), 
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:5000/kmeans'); // Host menggunakan local IPV4

            // Log respons dari API
            Log::info('Response:', ['response' => $response->body()]);
    
            // Cek apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();
                
                return view('kmeans.Result', [
                    'optimal_k' => $data['optimal_k'],
                    'silhouette_score' => $data['silhouette_score'],
                    'final_centroids' => $data['final_centroids'],
                    'data' => $data['data'],
                    // 'davies_bouldin_index' => $data['davies_bouldin_index'],
                    // 'result_file' => $data['result_file']
                ]);
            } else {
                return back()->withErrors(['error' => 'Gagal memproses file. Status: ' . $response->status()]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error during API call:', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses API.']);
        }
    }

    public function elbowMethod()
    {
        
    }
}
