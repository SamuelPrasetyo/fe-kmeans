@extends('layouts.app')

@section('title', 'Hasil Clustering')

@section('content')
<div>
    <p>{{ $optimal_k }}</p>
    <p>{{ $silhouette_score }}</p>

    <h3>Centroid Akhir</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Centroid</th>
                <th>NBINDO</th>
                <th>NBINGGRIS</th>
                <th>NIPA</th>
                <th>NMTK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($final_centroids as $index => $centroid)
            <tr>
                <td>Centroid {{ $index + 1 }}</td>
                @foreach ($centroid as $value)
                <td>{{ number_format($value, 2) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Data Siswa</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Cluster</th>
                <th>NBINDO</th>
                <th>NBINGGRIS</th>
                <th>NIPA</th>
                <th>NMTK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $student)
            <tr>
                <td>{{ $student['Cluster'] }}</td>
                <td>{{ $student['NBINDO'] }}</td>
                <td>{{ $student['NBINGGRIS'] }}</td>
                <td>{{ $student['NIPA'] }}</td>
                <td>{{ $student['NMTK'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection