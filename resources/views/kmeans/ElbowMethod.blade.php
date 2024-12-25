@extends('layouts.app')

@section('title', 'Elbow Method K-Means')

@section('content')
<style>
    #header-table {
        background-color: yellow;
        width: 120px;
    }
</style>

<div style="display: flex; align-items: flex-start; gap: 20px;">
    <!-- Tabel Nilai Distortions -->
    <div style="flex: 1; text-align: center;">
        <h3>Distortions</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: yellow;">Index</th>
                    <th style="background-color: yellow;">Distortion Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distortions as $index => $value)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $value }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Gambar Plot -->
    <div style="flex: 1; text-align: center; margin-right: 1%;">
        <h3>Elbow Method</h3>
        <img src="data:image/png;base64,{{ $plot }}" alt="Distortion Plot" style="max-width: 100%; height: auto; border: 1px solid #ccc;" />
    </div>
</div>

@endsection