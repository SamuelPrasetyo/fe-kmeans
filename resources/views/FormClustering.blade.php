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
            <!-- <form action="/clustering" method="post">
                @csrf
                <div class="mb-3">
                    <label for="k" class="form-label">Jumlah K</label>
                    <input type="number" class="form-control" id="k" name="k" placeholder="Jumlah K" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form> -->

            <form action="{{ route('kmeans') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="file">Upload File Excel:</label>
                <input type="file" name="file" id="file" required>
                <button type="submit">Proses</button>
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