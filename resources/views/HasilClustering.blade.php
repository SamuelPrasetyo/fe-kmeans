@extends('layouts.app')

@section('title', 'Cluster Result')

@section('content')
<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h3>Hasil Clustering</h3>
        </div>
        <div class="card-body">
            @if ($message = Session::get('Sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button> 
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Nilai Matematika</th>
                    <th>Nilai B.Inggris</th>
                    <th>Nilai B.Indo</th>
                    <th>Nilai IPA</th>
                    <th>Cluster</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($data as $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $n['nis'] }}</td>
                        <td>{{ $n['nama_siswa'] }}</td>
                        <td>{{ $n['nmatematika'] }}</td>
                        <td>{{ $n['nbinggris'] }}</td>
                        <td>{{ $n['nbindo'] }}</td>
                        <td>{{ $n['nipa'] }}</td>
                        <td>{{ $n['cluster'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection