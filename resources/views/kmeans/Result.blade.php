@extends('layouts.app')

@section('title', 'Hasil Clustering K-Means')

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<style>
    #myTable thead th, #myTable tbody td {
        text-align: center; /* Mengatur teks ke tengah */
        vertical-align: middle; /* Memastikan teks berada di tengah secara vertikal */
    }

    #header-table {
        background-color: yellow;
        /* width: 120px; */
    }

    h3 {
        margin-top: 20px;
    }

    table.table th,
    table.table td {
        min-width: 150px;
        /* Lebar minimum kolom */
        text-align: center;
        /* Teks rata tengah */
    }

    table.table th:first-child,
    table.table td:first-child {
        min-width: 50px;
        /* Lebar untuk kolom No */
    }

    /* Kolom nama siswa lebih lebar */
    table.table th:nth-child(6),
    table.table td:nth-child(6) {
        min-width: 200px;
        /* Kolom nama siswa */
    }
</style>

<div style="margin-right: 1%;">
    <h1>Hasil Clustering K-Means</h1>
    <table class="mb-3">
        <tr>
            <td>Tahun Ajar</td>
            <td style="padding: 0 10px;">:</td>
            <td>{{ substr($tahunajar, 0, 4) . ' / ' . substr($tahunajar, 4) }}</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td style="padding: 0 10px;">:</td>
            <td>{{ $semester }}</td>
        </tr>
    </table>

    <a href="{{ route('download.excel') }}" target="_blank" class="btn btn-primary">Download Laporan</a>

    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 20px;">
        <!-- Grafik Jumlah Data per Cluster -->
        <div style="flex: 1;">
            <h3 style="text-align: center;">Grafik Jumlah Data per Cluster</h3>
            <canvas id="clusterChart" style="width: 100%; height: auto;"></canvas>
        </div>
        
        <!-- Table Hasil Evaluasi Clustering -->
        <div style="flex: 1;">
            <h3 style="text-align: center;">Hasil Evaluasi Clustering</h3>
            <table class="table table-bordered" style="width: 100%;">
                <tr>
                    <td>Davies Bouldin Index</td>
                    <td>{{ $davies_bouldin_index }}</td>
                </tr>
                <tr>
                    <td>Silhouette Score</td>
                    <td>{{ $silhouette_score }}</td>
                </tr>
                <tr>
                    <td>Calinski Harabasz Index</td>
                    <td>{{ $calinski_harabasz_index }}</td>
                </tr>
                <!-- <tr>
                    <td>Sum Squared Error</td>
                    <td>{{ $sum_squared_error }}</td>
                </tr> -->
            </table>
        </div>
    </div>

    <!-- Table Nilai Centroid Akhir -->
    <h3 style="text-align: center;">Nilai Centroid Final</h3>
    <center>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th id="header-table">Dimensi</th>
                    @foreach ($final_centroids as $index => $centroid)
                    <th id="header-table">Centroid {{ $index + 1 }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($final_centroids[0] as $dimIndex => $value)
                <tr>
                    <td>Dimensi {{ $dimIndex + 1 }}</td>
                    @foreach ($final_centroids as $centroid)
                    <td>{{ $centroid[$dimIndex] }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </center>

    <h3 style="text-align: center;">Data Cluster</h3>
    <div style="overflow-x: auto; white-space: nowrap;">
        <table class="table table-bordered table-striped" id="myTable">
            <thead class="text-center">
                <tr>
                    <th id="header-table">No.</th>
                    <th id="header-table">Cluster</th>
                    <th id="header-table">Tahun Ajar</th>
                    <th id="header-table">Semester</th>
                    <th id="header-table">Kelas</th>
                    <th id="header-table">NIS</th>
                    <th id="header-table" style="width: 150px;">Nama Siswa</th>
                    <th id="header-table">AGAMA</th>
                    <th id="header-table">B. INDO</th>
                    <th id="header-table">B. INGGRIS</th>
                    <th id="header-table">IPA</th>
                    <th id="header-table">IPS</th>
                    <th id="header-table">MTK</th>
                    <th id="header-table">PJOK</th>
                    <th id="header-table">PKN</th>
                    <th id="header-table">PRAKARYA</th>
                    <th id="header-table">SENI BUDAYA</th>
                    <th id="header-table">TIK</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row['Cluster'] }}</td>
                    <td>{{ substr($row['Tahun Ajar'], 0, 4) . ' / ' . substr($row['Tahun Ajar'], 4) }}</td>
                    <td>{{ $row['Semester'] }}</th>
                    <td>{{ $row['Kelas'] }}</th>
                    <td>{{ $row['NIS'] }}</th>
                    <td>{{ $row['Nama Siswa'] }}</th>
                    <td>{{ $row['NAGAMA'] }}</td>
                    <td>{{ $row['NBINDO'] }}</td>
                    <td>{{ $row['NBINGGRIS'] }}</td>
                    <td>{{ $row['NIPA'] }}</td>
                    <td>{{ $row['NIPS'] }}</td>
                    <td>{{ $row['NMATEMATIKA'] }}</td>
                    <td>{{ $row['NPJOK'] }}</td>
                    <td>{{ $row['NPKN'] }}</td>
                    <td>{{ $row['NPRAKARYA'] }}</td>
                    <td>{{ $row['NSENIBUDAYA'] }}</td>
                    <td>{{ $row['NTIK'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection



@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Cluster untuk Grafik Doughnut
    const ctx = document.getElementById('clusterChart').getContext('2d');
    const data = {
        labels: <?php echo json_encode($clusters->keys()); ?>, // Nama cluster
        datasets: [{
            label: 'Jumlah Data',
            data: <?php echo json_encode($clusters->values()); ?>, // Jumlah data per cluster
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
        }]
    };

    const config = {
        type: 'doughnut', // Ubah tipe grafik menjadi doughnut
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                // title: {
                //     display: true,
                //     text: 'Grafik Jumlah Data per Cluster'
                // }
            },
            aspectRatio: 3
        }
    };

    // Inisialisasi Chart
    const clusterChart = new Chart(ctx, config);
</script>
@endsection