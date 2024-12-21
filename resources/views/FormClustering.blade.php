@extends('layouts.app')

@section('title', 'Form Clustering')

@section('content')
<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h3>Form Clustering</h3>
        </div>

        <!-- <div class="card-body">
            <form action="{{ route('process-clustering') }}" method="POST" enctype="multipart/form-data" target="_blank">
                @csrf
                <label for="file">Upload File Excel:</label>
                <input type="file" name="file" id="file" required><br>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="algoritma" value="kmeans">Proses K-Means</button>
                    <button class="btn btn-warning" type="submit" name="algoritma" value="dbscan">Proses DBSCAN</button>
                    <button class="btn btn-danger" type="submit" name="algoritma" value="meanshift">Proses Mean Shift</button>
                </div>
            </form>

            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div> -->

        <div class="card-body">
            <form action="nilai-siswa-filter" method="GET">
                @csrf
                <label for="select-tahunajar">Tahun Ajar</label>
                <select class="form-select mt-2" name="tahunajar" required>
                    <option value="" selected>-- Pilih Tahun Ajar --</option>
                    @foreach($tahunajar as $thajar)
                        <option value="{{ $thajar->value }}">{{ $thajar->label }}</option>
                    @endforeach
                </select>

                <label class="mt-3" for="select-semester">Semester</label>
                <select class="form-select mt-2" name="semester" required>
                    <option value="" selected>-- Pilih Semester --</option>
                    @foreach($semester as $smt)
                        <option value="{{ $smt->semester }}">{{ $smt->semester }}</option>
                    @endforeach
                </select>

                <!-- Button untuk memproses Algoritma Masing2 -->
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" style="width: 100px;">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection