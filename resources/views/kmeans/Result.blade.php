@extends('layouts.app')

@section('title', 'Hasil Clustering K-Means')

@section('content')
<div>
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

    <h3>Nilai Centroid Final</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                @foreach ($final_centroids[0] as $index => $value)
                <th>Dimension {{ $index + 1 }}</th>
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
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Cluster</th>
                <th>NAGAMA</th>
                <th>NBINDO</th>
                <th>NBINGGRIS</th>
                <th>NIPA</th>
                <th>NIPS</th>
                <th>NMATEMATIKA</th>
                <th>NPJOK</th>
                <th>NPKN</th>
                <th>NPRAKARYA</th>
                <th>NSENIBUDAYA</th>
                <th>NTIK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row['Cluster'] }}</td>
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