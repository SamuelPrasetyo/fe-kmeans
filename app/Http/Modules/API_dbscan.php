<?php

namespace App\Http\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class API_dbscan
{
    public function index($tahunajar, $semester, $eps, $min_pts)
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/dbscan', [
                'tahunajar' => $tahunajar,
                'semester' => $semester,
                'eps' => $eps,
                'min_pts' => $min_pts
            ]);

            // Log respons dari API
            Log::info('Response:', ['response' => $response->body()]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();

                // Hitung jumlah data per cluster
                $clusters = collect($data['data'])->groupBy('Cluster')->map(function ($items) {
                    return count($items); // Hitung jumlah data dalam setiap cluster
                });

                // Simpan data ke session
                session([
                    'clustering_result' => [
                        'algoritma' => 'dbscan',
                        'semester' => $semester,
                        'tahunajar' => $tahunajar,
                        'davies_bouldin_index' => $data['evaluation']['davies_bouldin_index'],
                        'silhouette_score' => $data['evaluation']['silhouette_score'],
                        'calinski_harabasz_index' => $data['evaluation']['calinski_harabasz_index'],
                        // 'sum_squared_error' => $data['evaluation']['sum_squared_error'],
                        // 'final_centroids' => $data['final_centroids'],
                        'data' => $data['data'],
                        'clusters' => $clusters
                    ]
                ]);

                return view('dbscan.Result', [
                    'davies_bouldin_index' => $data['evaluation']['davies_bouldin_index'],
                    'silhouette_score' => $data['evaluation']['silhouette_score'],
                    'calinski_harabasz_index' => $data['evaluation']['calinski_harabasz_index'],
                    'data' => $data['data'],
                    'clusters' => $clusters
                ]);
            } else {
                return back()->withErrors(['error' => 'Gagal memproses clustering. Status: ' . $response->status()]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error during API call:', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses API.']);
        }
    }

    public function kdistanceGraph($tahunajar, $semester)
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/find-params', [
                'tahunajar' => $tahunajar,
                'semester' => $semester
            ]);

            // Log respons dari API
            Log::info('Response:', ['response' => $response->body()]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();

                return view('dbscan.KDistanceGraph', [
                    'tahunajar' => $tahunajar,
                    'semester' => $semester,
                    'results' => $data['results'],
                    'k_distance_plot' => $data['k_distance_plot']
                ]);
            } else {
                return back()->withErrors(['error' => 'Gagal memproses K-Distance Graph. Status: ' . $response->status()]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error during API call:', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses API.']);
        }
    }
}
