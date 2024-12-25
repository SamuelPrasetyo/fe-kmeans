@extends('layouts.app')

@section('title', 'Nilai Siswa')

@section('content')
<style>
    #button {
        width: 200px;
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

<div class="container">
    <h1>Data Nilai Siswa</h1>

    <table>
        <tr>
            <td>Tahun Ajar</td>
            <td style="padding: 0 10px;">:</td>
            <td>{{ substr($result[0]->tahunajar, 0, 4) . ' / ' . substr($result[0]->tahunajar, 4) }}</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td style="padding: 0 10px;">:</td>
            <td>{{ $result[0]->semester }}</td>
        </tr>
    </table>

    <form action="{{ route('process-clustering') }}" method="POST" target="_blank">
        @csrf
        <input type="hidden" name="tahunajar" value="{{ json_encode($result[0]->tahunajar) }}">
        <input type="hidden" name="semester" value="{{ json_encode($result[0]->semester) }}">
        <div class="mt-3 mb-3">
            <div class="d-flex flex-row flex-wrap">
                <div class="card" style="width: 24rem; margin-right: 1rem;">
                    <div class="card-body">
                        <h5 class="card-title">K-Means</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Algoritma K-Means</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-link" type="submit" name="algoritma" value="elbow-method">Elbow Method</button>
                            <button class="btn btn-primary" type="submit" name="algoritma" value="kmeans">Proses K-Means</button>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 24rem; margin-right: 1rem;">
                    <div class="card-body">
                        <h5 class="card-title">DBSCAN</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Algoritma DBSCAN</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-link" type="submit" name="algoritma" value="kdgraph">K-Distance Graph</button>
                            <button class="btn btn-warning" type="submit" name="algoritma" value="dbscan">Proses DBSCAN</button>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 24rem; margin-right: 1rem;">
                    <div class="card-body">
                        <h5 class="card-title">Agglomerative</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Algoritma Agglomerative</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="card-link">Elbow Method</a>
                            <button class="btn btn-success" type="submit" name="algoritma" value="agglomerative">Proses Agglomerative</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>

    <div style="overflow-x: auto; white-space: nowrap;">
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <th>No.</th>
                <th>Semester</th>
                <th>Tahun Ajar</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th style="width: 150px;">Nama Siswa</th>
                <th>Agama</th>
                <th>PKN</th>
                <th>Bahasa Indonesia</th>
                <th>Matematika</th>
                <th>IPA</th>
                <th>IPS</th>
                <th>Bahasa Inggris</th>
                <th>Seni Budaya</th>
                <th>PJOK</th>
                <th>Prakarya</th>
                <th>TIK</th>
            </thead>
            <tbody class="text-center">
                @foreach ($result as $index => $n)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $n->semester }}</td>
                    <td>{{ substr($n->tahunajar, 0, 4) . ' / ' . substr($n->tahunajar, 4) }}</td>
                    <td>{{ $n->nis }}</td>
                    <td>{{ $n->kelas }}</td>
                    <td>{{ $n->nama_siswa }}</td>
                    <td>{{ $n->nagama }}</td>
                    <td>{{ $n->npkn }}</td>
                    <td>{{ $n->nbindo }}</td>
                    <td>{{ $n->nmatematika }}</td>
                    <td>{{ $n->nipa }}</td>
                    <td>{{ $n->nips }}</td>
                    <td>{{ $n->nbinggris }}</td>
                    <td>{{ $n->nsenibudaya }}</td>
                    <td>{{ $n->npjok }}</td>
                    <td>{{ $n->nprakarya }}</td>
                    <td>{{ $n->ntik }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection