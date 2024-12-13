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
                    <th>Semester</th>
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