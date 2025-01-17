@extends('layouts.app')

@section('title', 'Hasil Perbandingan Algoritma')

@section('content')
<style>
    #highlight {
        background-color: yellow;
        font-weight: bold;
    }

    table.table th,
    table.table td {
        text-align: center;
        vertical-align: middle;
    }
</style>

<div class="container">
<h1 class="text-center mb-4">Hasil Perbandingan</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th rowspan="2">Tahun Ajar</th>
                    <th rowspan="2">Semester</th>
                    <th colspan="3">K-Means</th>
                    <th colspan="3">DBSCAN</th>
                    <th colspan="3">Agglomerative</th>
                </tr>
                <tr>
                    <th>CHI</th>
                    <th>DBI</th>
                    <th>SS</th>
                    <th>CHI</th>
                    <th>DBI</th>
                    <th>SS</th>
                    <th>CHI</th>
                    <th>DBI</th>
                    <th>SS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiEvaluasi as $tahunajar => $semesters)
                    <!-- Loop pertama: Iterasi setiap Tahun Ajar dalam data evaluasi -->
                    @foreach ($semesters as $semester => $records)
                        <!-- Loop kedua: Iterasi setiap Semester dalam Tahun Ajar tertentu -->
                        <tr>
                            <td>{{ $tahunajar }}</td>
                            <td>{{ $semester }}</td>
                            @foreach ($records as $record)
                                <td id="{{ $record->is_best_chi ? 'highlight' : '' }}">{{ number_format($record->chi, 3) }}</td>
                                <td id="{{ $record->is_best_dbi ? 'highlight' : '' }}">{{ number_format($record->dbi, 3) }}</td>
                                <td id="{{ $record->is_best_ss ? 'highlight' : '' }}">{{ number_format($record->ss, 3) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
                <tr class="table-danger text-white font-weight-bold">
                    <td colspan="2" style="font-weight: bold;">Jumlah per Metrik</td>
                    <td>{{ $jumlahEvaluasi['k-means']['chi'] }}</td>
                    <td>{{ $jumlahEvaluasi['k-means']['dbi'] }}</td>
                    <td>{{ $jumlahEvaluasi['k-means']['ss'] }}</td>
                    <td>{{ $jumlahEvaluasi['dbscan']['chi'] }}</td>
                    <td>{{ $jumlahEvaluasi['dbscan']['dbi'] }}</td>
                    <td>{{ $jumlahEvaluasi['dbscan']['ss'] }}</td>
                    <td>{{ $jumlahEvaluasi['agglomerative']['chi'] }}</td>
                    <td>{{ $jumlahEvaluasi['agglomerative']['dbi'] }}</td>
                    <td>{{ $jumlahEvaluasi['agglomerative']['ss'] }}</td>
                </tr>
                <tr class="table-primary text-white font-weight-bold">
                    <td colspan="2" style="font-weight: bold;">Jumlah per Algoritma</td>
                    <td colspan="3">{{ $jumlahKeseluruhan['k-means'] }}</td>
                    <td colspan="3">{{ $jumlahKeseluruhan['dbscan'] }}</td>
                    <td colspan="3">{{ $jumlahKeseluruhan['agglomerative'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h1 class="text-center mt-3 mb-4">Informasi Nilai Parameter</h1>
    <table class="table table-bordered table-hover text-center">
        <thead class="table-warning">
            <th>No.</th>
            <th>Semester</th>
            <th>Tahun Ajar</th>
            <th>Algoritma</th>
            <th>Nilai Parameter</th>
        </thead>
        <tbody>
            @foreach ($parameter as $index => $params)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $params->semester }}</td>
                <td>{{ $params->tahunajar }}</td>
                <td>{{ $params->algoritma }}</td>
                <td>{{ $params->parameter }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection