<?php

namespace App\Http\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class API_dbscan
{
    public function index($file)
    {
        try {
            // Kirim file ke API
            $response = Http::attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:5000/dbscan'); // Host menggunakan local IPV4

            // Log respons dari API
            Log::info('Response:', ['response' => $response->body()]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();

                // Hitung jumlah data per cluster
                $clusters = collect($data['data'])->groupBy('Cluster')->map(function ($items) {
                    return count($items); // Hitung jumlah data dalam setiap cluster
                });

                return view('dbscan.Result', [
                    'davies_bouldin_index' => $data['davies_bouldin_index'],
                    'silhouette_score' => $data['silhouette_score'],
                    'calinski_harabasz_index' => $data['calinski_harabasz_index'],
                    'sum_squared_error' => $data['sum_squared_error'],
                    'image' => $data['k_distance_graph'],
                    'data' => $data['data'],
                    'clusters' => $clusters
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
}
