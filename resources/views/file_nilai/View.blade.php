@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h3>Data Siswa</h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                            + Tambah
                        </button>
                    </div>
                </div>
            </div>
            
            @if ($message = Session::get('Sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <!-- <strong>{{ $message }}</strong> -->
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button> 
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <th>No.</th>
                    <th>Nama File</th>
                    <th>Action</th>
                </thead>
                <!-- <tbody class="text-center">
                </tbody> -->
            </table>
        </div>
    </div>
</div>

<!-- Import Excel Modal -->
<div class="modal fade" id="importExcelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelModalLabel">Import Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="data/nilaisiswa/import" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Pilih file Excel :</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xls,.xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection