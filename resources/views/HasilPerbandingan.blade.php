@extends('layouts.app')

@section('title', 'Hasil Perbandingan Algoritma')

@section('content')
<style>
    /* Loading animation */
    #loading {
        display: none;
        text-align: center;
        font-size: 24px;
    }

    /* Highlight style for the best value */
    #highlight {
        font-weight: bold;
        background-color: yellow;
    }

    table.table th,
    table.table td {
        text-align: center;
        vertical-align: middle;
    }

    /* Center align all cells by default */
    td {
        text-align: center;
    }
</style>

<div class="container">
    <h1>Hasil Perbandingan</h1>

    <!-- Menu and loading -->
    <div id="loading">Loading...</div>

    <!-- Results will be appended here -->
    <div id="results-container"></div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    // Function to fetch results from API
    function fetchResults() {
        $('#loading').show(); // Show loading animation

        let resultsData = {
            kmeans: [],
            dbscan: [],
            agglomerative: []
        };

        // Fetch K-Means results
        $.ajax({
            url: 'http://127.0.0.1:5000/hasil-perbandingan-k-means',
            method: 'POST',
            contentType: 'application/json',
            success: function(response) {
                resultsData.kmeans = response.results;
                checkAllResultsFetched();
            },
            error: function(xhr) {
                console.error('Error fetching K-Means results:', xhr);
                alert('Error fetching K-Means results');
            }
        });

        // Fetch DBSCAN results
        $.ajax({
            url: 'http://127.0.0.1:5000/hasil-perbandingan-dbscan',
            method: 'POST',
            contentType: 'application/json',
            success: function(response) {
                resultsData.dbscan = response.results;
                checkAllResultsFetched();
            },
            error: function(xhr) {
                console.error('Error fetching DBSCAN results:', xhr);
                alert('Error fetching DBSCAN results');
            }
        });

        // Fetch Agglomerative results
        $.ajax({
            url: 'http://127.0.0.1:5000/hasil-perbandingan-agglomerative',
            method: 'POST',
            contentType: 'application/json',
            success: function(response) {
                resultsData.agglomerative = response.results;
                checkAllResultsFetched();
            },
            error: function(xhr) {
                console.error('Error fetching Agglomerative results:', xhr);
                alert('Error fetching Agglomerative results');
            }
        });

        function checkAllResultsFetched() {
            if (resultsData.kmeans.length > 0 && resultsData.dbscan.length > 0 && resultsData.agglomerative.length > 0) {
                renderTable(resultsData);
                $('#loading').hide();
            }
        }
    }

    // Function to render the table with highlight and center-aligned text, and total calculations
    function renderTable(resultsData) {
        let tableRows = '';
        let totals = {
            kmeans: {
                CHI: 0,
                DBI: 0,
                SS: 0
            },
            dbscan: {
                CHI: 0,
                DBI: 0,
                SS: 0
            },
            agglomerative: {
                CHI: 0,
                DBI: 0,
                SS: 0
            }
        };

        resultsData.kmeans.forEach((result, index) => {
            const dbscanResult = resultsData.dbscan.find(r => r.semester === result.semester && r.tahun_ajar === result.tahun_ajar);
            const agglomerativeResult = resultsData.agglomerative.find(r => r.semester === result.semester && r.tahun_ajar === result.tahun_ajar);

            // Get all metrics
            const metrics = {
                kmeans: result.kmeans || {},
                dbscan: dbscanResult ? dbscanResult.evaluation : {},
                agglomerative: agglomerativeResult ? agglomerativeResult.agglomerative : {}
            };

            // Find the best values
            const bestCHI = Math.max(metrics.kmeans.calinski_harabasz_index || 0, metrics.dbscan.calinski_harabasz_index || 0, metrics.agglomerative.calinski_harabasz_index || 0);
            const bestDBI = Math.min(metrics.kmeans.davies_bouldin_index || Infinity, metrics.dbscan.davies_bouldin_index || Infinity, metrics.agglomerative.davies_bouldin_index || Infinity);
            const bestSS = Math.max(metrics.kmeans.silhouette_score || 0, metrics.dbscan.silhouette_score || 0, metrics.agglomerative.silhouette_score || 0);

            // Update totals for the best metrics
            if (metrics.kmeans.calinski_harabasz_index === bestCHI) totals.kmeans.CHI++;
            if (metrics.kmeans.davies_bouldin_index === bestDBI) totals.kmeans.DBI++;
            if (metrics.kmeans.silhouette_score === bestSS) totals.kmeans.SS++;

            if (metrics.dbscan.calinski_harabasz_index === bestCHI) totals.dbscan.CHI++;
            if (metrics.dbscan.davies_bouldin_index === bestDBI) totals.dbscan.DBI++;
            if (metrics.dbscan.silhouette_score === bestSS) totals.dbscan.SS++;

            if (metrics.agglomerative.calinski_harabasz_index === bestCHI) totals.agglomerative.CHI++;
            if (metrics.agglomerative.davies_bouldin_index === bestDBI) totals.agglomerative.DBI++;
            if (metrics.agglomerative.silhouette_score === bestSS) totals.agglomerative.SS++;

            // Render table row with highlight and center-aligned text
            tableRows += `
                    <tr>
                        <td>${result.tahun_ajar}</td>
                        <td>${result.semester}</td>
                        <!-- K-Means -->
                        <td id="${metrics.kmeans.calinski_harabasz_index === bestCHI ? 'highlight' : ''}">${metrics.kmeans.calinski_harabasz_index?.toFixed(3) || 'N/A'}</td>
                        <td id="${metrics.kmeans.davies_bouldin_index === bestDBI ? 'highlight' : ''}">${metrics.kmeans.davies_bouldin_index?.toFixed(3) || 'N/A'}</td>
                        <td id="${metrics.kmeans.silhouette_score === bestSS ? 'highlight' : ''}">${metrics.kmeans.silhouette_score?.toFixed(3) || 'N/A'}</td>
                        <!-- DBSCAN -->
                        <td id="${metrics.dbscan.calinski_harabasz_index === bestCHI ? 'highlight' : ''}">${metrics.dbscan.calinski_harabasz_index?.toFixed(3) || 'N/A'}</td>
                        <td id="${metrics.dbscan.davies_bouldin_index === bestDBI ? 'highlight' : ''}">${metrics.dbscan.davies_bouldin_index?.toFixed(3) || 'N/A'}</td>
                        <td id="${metrics.dbscan.silhouette_score === bestSS ? 'highlight' : ''}">${metrics.dbscan.silhouette_score?.toFixed(3) || 'N/A'}</td>
                        <!-- Agglomerative -->
                        <td id="${metrics.agglomerative.calinski_harabasz_index === bestCHI ? 'highlight' : ''}">${metrics.agglomerative.calinski_harabasz_index?.toFixed(3) || 'N/A'}</td>
                        <td id="${metrics.agglomerative.davies_bouldin_index === bestDBI ? 'highlight' : ''}">${metrics.agglomerative.davies_bouldin_index?.toFixed(3) || 'N/A'}</td>
                        <td id="${metrics.agglomerative.silhouette_score === bestSS ? 'highlight' : ''}">${metrics.agglomerative.silhouette_score?.toFixed(3) || 'N/A'}</td>
                    </tr>
                `;
        });

        // Add totals row
        tableRows += `
            <tr class="table-danger">
                <td colspan="2" class="text-center"><strong>Jumlah Evaluasi</strong></td>
                <!-- Totals for K-Means -->
                <td>${totals.kmeans.CHI}</td>
                <td>${totals.kmeans.DBI}</td>
                <td>${totals.kmeans.SS}</td>
                <!-- Totals for DBSCAN -->
                <td>${totals.dbscan.CHI}</td>
                <td>${totals.dbscan.DBI}</td>
                <td>${totals.dbscan.SS}</td>
                <!-- Totals for Agglomerative -->
                <td>${totals.agglomerative.CHI}</td>
                <td>${totals.agglomerative.DBI}</td>
                <td>${totals.agglomerative.SS}</td>
            </tr>
            <tr class="table-primary">
                <td colspan="2" class="text-center"><strong>Jumlah Keseluruhan</strong></td>
                <td colspan="3">${totals.kmeans.CHI + totals.kmeans.DBI + totals.kmeans.SS}</td>
                <td colspan="3">${totals.dbscan.CHI + totals.dbscan.DBI + totals.dbscan.SS}</td>
                <td colspan="3">${totals.agglomerative.CHI + totals.agglomerative.DBI + totals.agglomerative.SS}</td>
            </tr>
        `;

        // Generate the final table structure
        const tableHTML = `
                <div class="mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2">Tahun Ajar</th>
                                <th rowspan="2">Semester</th>
                                <th colspan="3">K-Means</th>
                                <th colspan="3">DBSCAN</th>
                                <th colspan="3">Agglomerative</th>
                            </tr>
                            <tr>
                                <th>CHI</th>
                                <th>DBI</th>
                                <th>SS</th>
                                <th>CHI</th>
                                <th>DBI</th>
                                <th>SS</th>
                                <th>CHI</th>
                                <th>DBI</th>
                                <th>SS</th>
                            </tr>
                        </thead>
                        <tbody>${tableRows}</tbody>
                    </table>
                </div>
            `;

        $('#results-container').append(tableHTML);
    }

    // Fetch results when page loads
    $(document).ready(function() {
        fetchResults();
    });
</script>
@endsection