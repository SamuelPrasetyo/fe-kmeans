@extends('layouts.app')

@section('title', 'Nilai Siswa')

@section('content')
<style>
    #button {
        width: 200px;
    }
</style>

<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h3>Data Nilai Siswa</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-5">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#importExcelModal" id="button">
                        Import
                    </button>
                    <a href="export-nilai-siswa" class="btn btn-light mb-3" id="button">Export</a>
                </div>
                <div class="col-4 text-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" id="button">
                        Hapus Semua Data
                    </button>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

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
                    <th>B. Indo</th>
                    <th>MTK</th>
                    <th>IPA</th>
                    <th>IPS</th>
                    <th>B. Inggris</th>
                    <th>Seni Budaya</th>
                    <th>PJOK</th>
                    <th>Prakarya</th>
                    <th>TIK</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($nilaisiswa as $index => $n)
                    <tr>
                        <!-- <td>{{ $loop->iteration }}</td> -->
                        <td>{{ $n->idnilai }}</td>
                        <td>{{ $n->semester }}</td>
                        <td>{{ $n->tahunajar }}</td>
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $nilaisiswa->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Data Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus semua data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <form action="/delete-nilai-siswa" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div

<!-- Import Excel Modal -->
<div class="modal fade" id="importExcelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelModalLabel">Import Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" ariaa-label="Close"></button>
            </div>
            <form action="import-nilai-siswa" method="POST" enctype="multipart/form-data">
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