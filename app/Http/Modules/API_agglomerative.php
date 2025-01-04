<?php

namespace App\Http\Modules;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class API_agglomerative
{
    public function index($tahunajar, $semester)
    {
        try {
            $response = Http::post('http://127.0.0.1:5000/agglomerative', [
                'tahunajar' => $tahunajar,
                'semester' => $semester
            ]);

            // Log respons dari API
            Log::info('Response:', ['response' => $response->body()]);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                $data = $response->json();

                // Validasi struktur respons
                if (!isset($data['evaluation'], $data['centroids'], $data['data'])) {
                    return back()->withErrors(['error' => 'Struktur respons API tidak valid.']);
                }

                // Hitung jumlah data per cluster
                $clusters = collect($data['data'])->groupBy('Cluster')->map(function ($items) {
                    return count($items); // Hitung jumlah data dalam setiap cluster
                });

                // Simpan data ke session
                session([
                    'clustering_result' => [
                        'algoritma' => 'agglomerative',
                        'semester' => $semester,
                        'tahunajar' => $tahunajar,
                        'davies_bouldin_index' => $data['evaluation']['davies_bouldin_index'],
                        'silhouette_score' => $data['evaluation']['silhouette_score'],
                        'calinski_harabasz_index' => $data['evaluation']['calinski_harabasz_index'],
                        'data' => $data['data'],
                        'final_centroids' => $data['centroids'],
                        'clusters' => $clusters
                    ]
                ]);

                return view('agglomerative.Result', [
                    'semester' => $semester,
                    'tahunajar' => $tahunajar,
                    'davies_bouldin_index' => $data['evaluation']['davies_bouldin_index'],
                    'silhouette_score' => $data['evaluation']['silhouette_score'],
                    'calinski_harabasz_index' => $data['evaluation']['calinski_harabasz_index'],
                    'final_centroids' => $data['centroids'],
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
}
