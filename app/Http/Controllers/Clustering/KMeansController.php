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

class KMeansController extends Controller
{
    public function kmeans($data, $k, $max_iterations = 100)
    {
        $centroids = $this->initializeCentroids($data, $k);
        
        $prev_centroids = [];
        
        for ($i = 0; $i < $max_iterations; $i++) {
            // assign clusters -> euclidean distance -> normalized data
            $clusters = $this->assignClusters($data, $centroids);
            // update centroids
            $centroids = $this->updateCentroids($data, $clusters, $k);
            
            if ($centroids == $prev_centroids) {
                break;
            }
            
            $prev_centroids = $centroids;
        }

        return [$centroids, $clusters];
    }

    public function initializeCentroids($data, $k)
    {
        // // Implementasi K-Means++
        // $centroids = [];

        // // Pilih centroid pertama secara acak
        // $centroids[] = $data[array_rand($data)];

        // for ($i = 1; $i < $k; $i++) { 
        //     $distances = [];
        //     foreach ($data as $point) {
        //         $min_distance = PHP_INT_MAX;
        //         foreach ($centroids as $centroid) {
        //             $distance = $this->euclideanDistance($point, $centroid);
        //             if ($distance < $min_distance) {
        //                 $min_distance = $distance;
        //             }
        //         }

        //         $distances[] = $min_distance;
        //     }

        //     // Pilih titik data berikutnya sebagai centroid dengan probabilitas
        //     // proporsional terhadap jarak
        //     $cumulative_distances = array_sum($distances);
        //     $random_distance = rand(0, $cumulative_distances);

        //     $cumulative_sum = 0;

        //     foreach ($data as $key => $point) {
        //         $cumulative_sum += $distances[$key];

        //         if ($cumulative_sum += $random_distance) {
        //             $centroids[] = $point;
        //             break;
        //         }
        //     }
        // }

        /* ATAU */

        // Menggunakan seed untuk pemilihan yang konsisten
        srand(0);
        $centroids = [];
        $keys = array_rand($data, $k);
        foreach ($keys as $key) {
            $centroids[] = $data[$key];
        }

        return $centroids;
    }

    public function assignClusters($data, $centroids)
    {
        $clusters = [];
        
        foreach ($data as $point) {
            $distances = [];
            foreach ($centroids as $centroid) {
                $distances[] = $this->euclideanDistance($point, $centroid);
            }
            $cluster = array_keys($distances, min($distances))[0];
            $clusters[] = $cluster;
        }

        return $clusters;
    }

    public function normalizedData($data)
    {
        $normalized = [];
        $keys = ['nmatematika', 'nbinggris', 'nbindo', 'nipa'];
        
        foreach ($data as $key => $value) {
            $normalized[array_search($key, $keys)] = $value;
        }

        return $normalized;
    }

    public function euclideanDistance($point1, $point2)
    {
        $point1 = $this->normalizedData($point1);
        $point2 = $this->normalizedData($point2);

        $sum = 0;

        for ($i = 0; $i < count($point1); $i++) {
            $sum += pow(($point1[$i] - $point2[$i]), 2);
        }   
        
        return sqrt($sum);
    }

    public function updateCentroids($data, $clusters, $k)
    {
        $keys = ['nmatematika', 'nbinggris', 'nbindo', 'nipa'];
        $new_centroids = array_fill(0, $k, array_fill_keys($keys, 0));
        $counts = array_fill(0, $k, 0);
        
        for ($i = 0; $i < count($data); $i++) { 
            $cluster = $clusters[$i];
            $counts[$cluster]++;
            foreach ($keys as $key) {
                $new_centroids[$cluster][$key] += $data[$i][$key];
            }
        }

        for ($i = 0; $i < $k; $i++) {
            foreach ($keys as $key) {
                if ($counts[$i] > 0) {
                    $new_centroids[$i][$key] /= $counts[$i];
                }
            }
        }

        return $new_centroids;
    }



}