@extends('layouts.app')

@section('title', 'Form Clustering')

@section('content')
<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h3>Form Clustering</h3>
        </div>

        @if ($message = Session::get('Sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('process-clustering') }}" method="POST" enctype="multipart/form-data" target="_blank">
                @csrf
                <label for="file">Upload File Excel:</label>
                <input type="file" name="file" id="file" required><br>

                <!-- Button untuk memproses Algoritma Masing2 -->
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
        </div>
    </div>
</div>
@endsection