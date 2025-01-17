<?php

namespace App\Http\Modules;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class API_Kmeans
{
    public function index($tahunajar, $semester, $n_clusters)
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/kmeans', [
                'tahunajar' => $tahunajar,
                'semester' => $semester,
                'n_clusters' => $n_clusters
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

                $evaluasiData = [
                    'semester' => $semester,
                    'tahunajar' => $tahunajar,
                    'algoritma' => 'K-Means',
                    'chi' => $data['evaluation']['calinski_harabasz_index'],
                    'dbi' => $data['evaluation']['davies_bouldin_index'],
                    'ss' => $data['evaluation']['silhouette_score'],
                    'parameter' => 'k = ' . $n_clusters
                ];
    
                // Update jika data dengan kombinasi semester, tahunajar, dan algoritma sudah ada
                DB::table('nilaievaluasi')->updateOrInsert(
                    [
                        'semester' => $semester,
                        'tahunajar' => $tahunajar,
                        'algoritma' => 'K-Means'
                    ],
                    $evaluasiData
                );

                // Simpan data ke session
                session([
                    'clustering_result' => [
                        'algoritma' => 'kmeans',
                        'semester' => $semester,
                        'tahunajar' => $tahunajar,
                        'davies_bouldin_index' => $data['evaluation']['davies_bouldin_index'],
                        'silhouette_score' => $data['evaluation']['silhouette_score'],
                        'calinski_harabasz_index' => $data['evaluation']['calinski_harabasz_index'],
                        'sum_squared_error' => $data['evaluation']['sum_squared_error'],
                        'data' => $data['data'],
                        'final_centroids' => $data['final_centroids'],
                        'clusters' => $clusters
                    ]
                ]);

                return view('kmeans.Result', [
                    'semester' => $semester,
                    'tahunajar' => $tahunajar,
                    // 'optimal_k' => $data['n_clusters'],
                    'davies_bouldin_index' => $data['evaluation']['davies_bouldin_index'],
                    'silhouette_score' => $data['evaluation']['silhouette_score'],
                    'calinski_harabasz_index' => $data['evaluation']['calinski_harabasz_index'],
                    'sum_squared_error' => $data['evaluation']['sum_squared_error'],
                    'final_centroids' => $data['final_centroids'],
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

    public function elbowMethod($tahunajar, $semester)
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/elbow-method', [
                'tahunajar' => $tahunajar,
                'semester' => $semester
            ]);

            // Log respons dari API
            Log::info('Response:', ['response' => $response->body()]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();

                return view('kmeans.ElbowMethod', [
                    'tahunajar' => $tahunajar,
                    'semester' => $semester,
                    'distortions' => $data['distortions'],
                    'plot' => $data['plot']
                ]);
            } else {
                return back()->withErrors(['error' => 'Gagal memproses Elbow Method. Status: ' . $response->status()]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error during API call:', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses API.']);
        }
    }
}
