@extends('layouts.app')

@section('title', 'Nilai Siswa')

@section('content')
<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h3>Data Nilai Siswa</h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                            Import
                        </button>
                        <a href="{{ url('nilaisiswa/export') }}" class="btn btn-light mb-3">Export</a>
                    </div>
                    <!-- <div class="col">
                        <div class="form-group">
                            <form action="#" method="get" class="form-inline">
                                <input class="btn btn-success" type="submit" value="Find" style="float: right; width: 80px;">
                                <input class="form-control" type="text" name="cari" placeholder="Search..." style="width: 200px; float: right;" autocomplete="off" required>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>
            
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
                </thead>
                <tbody class="text-center">
                    @foreach ($nilaisiswa as $index => $n)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $n->nis }}</td>
                        <td>{{ $n->nama_siswa }}</td>
                        <td>{{ $n->nmatematika }}</td>
                        <td>{{ $n->nbinggris }}</td>
                        <td>{{ $n->nbindo }}</td>
                        <td>{{ $n->nipa }}</td>
                        <!-- <td width="200px">
                            <a href="/transaksi/update/{{ $n->id }}" class="btn btn-warning" style="width: 75px;">Edit</a> |
                            <a href="/transaksi/delete/{{ $n->id }}" class="btn btn-danger" style="width: 75px;">Hapus</a>
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
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
            <form action="/nilaisiswa/import" method="POST" enctype="multipart/form-data">
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