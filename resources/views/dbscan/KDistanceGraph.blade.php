@extends('layouts.app')

@section('title', 'K-Distance Graph')

@section('content')
<style>
    #header-table {
        background-color: yellow;
        width: 120px;
    }
</style>

<table style="font-weight: bold;">
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

<div style="display: flex; align-items: flex-start; gap: 20px;">
    <!-- Tabel Pencarian Nilai Params Terbaik -->
    <div style="flex: 1; text-align: center;">
        <h3>Best Params</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th id="header-table">Jumlah Cluster</th>
                    <th id="header-table">EPS</th>
                    <th id="header-table">Min PTS</th>
                    <th id="header-table">Calinski-Harabasz Index</th>
                    <th id="header-table">Davies-Bouldin Index</th>
                    <th id="header-table">Silhouette Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                <tr>
                    <td>{{ $result['num_clusters'] }}</td>
                    <td>{{ $result['eps'] }}</td>
                    <td>{{ $result['min_pts'] }}</td>
                    <td>{{ $result['calinski_harabasz_index'] == -1 ? 'N/A' : number_format($result['calinski_harabasz_index'], 2) }}</td>
                    <td>{{ $result['davies_bouldin_index'] == -1 ? 'N/A' : number_format($result['davies_bouldin_index'], 2) }}</td>
                    <td>{{ $result['silhouette_score'] == -1 ? 'N/A' : number_format($result['silhouette_score'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Gambar Plot -->
    <div style="flex: 1; text-align: center; margin-right: 1%;">
        <h3>K-Distance Graph</h3>
        <img src="{{ $k_distance_plot }}" alt="K-Distance Graph" style="max-width: 100%; height: auto; border: 1px solid #ccc;" />
    </div>
</div>

@endsection