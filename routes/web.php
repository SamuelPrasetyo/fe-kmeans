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

Route::get('', [App\Http\Controllers\AuthController::class, 'PageLogin']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'Login']);
Route::get('logout', [App\Http\Controllers\AuthController::class, 'Logout']);
Route::get('dashboard', [App\Http\Controllers\MainController::class, 'index']);

/* Route Nilai Siswa */
    Route::get('nilaisiswa', [App\Http\Controllers\Data\NilaiSiswaController::class, 'index']);
    Route::post('import-nilai-siswa', [App\Http\Controllers\Data\ExcelController::class, 'import_excel']);
    Route::get('export-nilai-siswa', [App\Http\Controllers\Data\ExcelController::class, 'export_excel']);
    Route::delete('delete-nilai-siswa', [App\Http\Controllers\Data\NilaiSiswaController::class, 'delete'])->name('delete-nilai-siswa');
    // Route::get('nilai-siswa-filtered', [App\Http\Controllers\Data\NilaiSiswaController::class, 'filter']);
    Route::get('nilai-siswa-filter', [App\Http\Controllers\Data\NilaiSiswaController::class, 'filter']);
/* End Route Nilai Siswa */

/* Route Process Clustering */
    Route::get('form-clustering', [App\Http\Controllers\MainController::class, 'formClustering']);
    Route::post('process-clustering', [App\Http\Controllers\MainController::class, 'processClustering'])->name('process-clustering');
/* End Route Process Clustering */

/* Route Download Excel Hasil Clustering */
    Route::get('/download-excel', [App\Http\Controllers\UtilityController::class, 'generateExcel'])->name('download.excel');
/* End Route Download Excel Hasil Clustering */