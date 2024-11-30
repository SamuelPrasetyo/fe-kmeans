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

use Illuminate\Support\Facades\Route;

Route::get('', [App\Http\Controllers\Auth\AuthController::class, 'PageLogin']);
Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'Login']);
Route::get('dashboard', [App\Http\Controllers\MainController::class, 'index']);



Route::prefix('data')->group(function () {
    Route::get('', [App\Http\Controllers\Data\FileNilaiController::class, 'index']);
    Route::post('nilaisiswa/import', [App\Http\Controllers\Data\ExcelController::class, 'import_excel']);
});






Route::get('/form-clustering', [App\Http\Controllers\MainController::class, 'formClustering']);
Route::post('/clustering', [App\Http\Controllers\Clustering\ClusteringController::class, 'clusterNilaiSiswa']); // tidak dipake



Route::post('/elbow-method', [App\Http\Controllers\Clustering\API_Kmeans::class, 'elbowMethod'])->name('elbow-method');
Route::post('/kmeans', [App\Http\Controllers\Clustering\API_Kmeans::class, 'index'])->name('kmeans');
