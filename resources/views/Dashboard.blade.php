@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h5 {
        color: #343a40;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center">Tentang Aplikasi</h2>
        </div>
        <div class="card-body">
            <p class="text-justify">
                Aplikasi ini dirancang untuk membantu menganalisis data nilai siswa menggunakan tiga algoritma clustering:
                <strong>K-Means</strong>, <strong>DBSCAN</strong>, dan <strong>Agglomerative Clustering</strong>. Aplikasi ini menyediakan fitur
                untuk mengimport dan mengeksport data nilai siswa serta memproses algoritma clustering dengan mudah melalui antarmuka
                pengguna yang sederhana. Setiap hasil analisis dapat diunduh dalam bentuk laporan.
            </p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <h2 class="text-center">Panduan Penggunaan</h2>
        </div>
        <div class="card-body">
            <p>Ikuti langkah-langkah berikut untuk memanfaatkan aplikasi secara maksimal:</p>

            <h5 class="mt-3">A. Mengimport Data Nilai Siswa</h5>
            <ol>
                <li>Klik menu <strong>Data Nilai Siswa</strong> di sidebar.</li>
                <li>Klik tombol <strong>Import</strong> dan unggah file nilai dalam format Excel.</li>
                <li>Klik <strong>Import</strong> untuk menyimpan data ke sistem.</li>
            </ol>

            <h5 class="mt-3">B. Mengeksport Data Nilai Siswa</h5>
            <ol>
                <li>Klik tombol <strong>Export</strong> pada menu <strong>Data Nilai Siswa</strong>.</li>
                <li>Pilih tempat penyimpanan file pada perangkat Anda.</li>
                <li>Klik <strong>Save</strong> untuk menyimpan file.</li>
            </ol>

            <h5 class="mt-3">C. Tahapan Memproses K-Means</h5>
            <ol>
                <li>Pilih menu <strong>Form Clustering</strong>, lalu masukkan periode tahun ajar dan semester.</li>
                <li>Klik tombol <strong>Elbow Method</strong> untuk menentukan nilai K terbaik.</li>
                <li>Klik tombol <strong>Proses K-Means</strong>, lalu masukkan nilai K sesuai hasil Elbow Method.</li>
                <li>Untuk mengunduh hasil analisis, klik tombol <strong>Download Laporan</strong>.</li>
            </ol>

            <h5 class="mt-3">D. Tahapan Memproses DBSCAN</h5>
            <ol>
                <li>Pilih menu <strong>Form Clustering</strong>, lalu masukkan periode tahun ajar dan semester.</li>
                <li>Klik tombol <strong>K-Distance Graph</strong> untuk melihat nilai parameter terbaik (eps dan minpts).</li>
                <li>Klik tombol <strong>Proses DBSCAN</strong>, lalu masukkan nilai eps dan minpts.</li>
                <li>Unduh laporan hasil analisis dengan mengklik tombol <strong>Download Laporan</strong>.</li>
            </ol>

            <h5 class="mt-3">E. Tahapan Memproses Agglomerative</h5>
            <ol>
                <li>Pilih menu <strong>Form Clustering</strong>, lalu masukkan periode tahun ajar dan semester.</li>
                <li>Klik tombol <strong>Proses Agglomerative</strong> untuk menjalankan algoritma.</li>
                <li>Klik tombol <strong>Download Laporan</strong> untuk menyimpan hasil analisis.</li>
            </ol>
        </div>
    </div>
</div>
@endsection