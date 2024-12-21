@extends('layouts.app')

@section('title', 'Hasil Clustering K-Means')

@section('content')
<style>
    #header-table {
        background-color: yellow;
        width: 120px;
    }

    .data-table {
        text-align: center;
    }
</style>

<div>
    <!-- Table Hasil Evaluasi Clustering -->
    <h3>Hasil Evaluasi Clustering</h3>
        <table class="table table-bordered" style="width: 25%;">
            <tr>
                <td>Optimal K</td>
                <td>{{ $optimal_k }}</td>
            </tr>
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
            <tr>
                <td>Sum Squared Error</td>
                <td>{{ $sum_squared_error }}</td>
            </tr>
        </table>
    
    <!-- Grafik di bawah hasil evaluasi -->
    <h3>Grafik Jumlah Data per Cluster</h3>
    <canvas id="clusterChart" style="max-width: 350px; height: 100px;"></canvas>

    <!-- Table Nilai Centroid Akhir -->
    <h3>Nilai Centroid Final</h3>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    @foreach ($final_centroids[0] as $index => $value)
                    <th id="header-table">Dimension {{ $index + 1 }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($final_centroids as $centroid)
                <tr>
                    @foreach ($centroid as $value)
                    <td>{{ $value }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

    <h3>Data Cluster</h3>
    <table class="table table-bordered table-striped data-table">
        <thead>
            <tr>
                <th id="header-table">No.</th>
                <th id="header-table">Cluster</th>
                <th id="header-table">Semester</th>
                <th id="header-table">Kelas</th>
                <th id="header-table">NIS</th>
                <th id="header-table">Nama Siswa</th>
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
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row['Cluster'] }}</td>
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
@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Cluster untuk Grafik
    const ctx = document.getElementById('clusterChart').getContext('2d');
    const clusterChart = new Chart(ctx, {
        type: 'bar', // Gunakan tipe bar (bisa juga pie atau line)
        data: {
            labels: {!! json_encode($clusters->keys()) !!}, // Nama cluster
            datasets: [{
                label: 'Jumlah Data',
                data: {!! json_encode($clusters->values()) !!}, // Jumlah data per cluster
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
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            aspectRatio: 3,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection