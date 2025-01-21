<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClusteringExport implements FromArray, WithStyles, WithColumnWidths, WithHeadings
{
    protected $data;
    protected $clusters;

    public function __construct($data, $clusters)
    {
        $this->data = $data;         // Data mentah
        $this->clusters = $clusters; // Hasil clustering
    }

    public function array(): array
    {
        $result = [];

        // Tambahkan jumlah cluster terlebih dahulu
        foreach ($this->clusters as $clusterId => $count) {
            $result[] = [
                'Cluster' => "$clusterId",
                'Jumlah' => $count,
            ];
        }

        // Sisipkan baris kosong sebagai pemisah
        $result[] = [
            'Cluster' => null,
            'Jumlah' => null,
        ];

        // Horizontal
        // Heading untuk final centroids
        // $centroids = session('clustering_result')['final_centroids'] ?? session('clustering_result')['centroids'] ?? [];
        // if (!empty($centroids)) {
        //     // Buat header untuk centroids
        //     $header = array_merge(['Cluster'], array_keys(current($centroids)));
        //     $result[] = $header;

        //     // Tambahkan data centroids ke dalam format horizontal
        //     foreach ($centroids as $clusterId => $centroid) {
        //         $row = array_merge(
        //             [$clusterId == -1 ? "Cluster -1" : "Cluster $clusterId"], // Nama cluster
        //             array_values($centroid) // Nilai centroid
        //         );
        //         $result[] = $row;
        //     }
        // }

        // Vertical
        // Heading untuk final centroids
        $centroids = session('clustering_result')['final_centroids'] ?? session('clustering_result')['centroids'] ?? [];
        $result[] = array_merge(
            ['Mata Pelajaran'],
            array_map(fn($index) => $index == -1 ? "Cluster -1" : "Cluster $index", array_keys($centroids))
        );

        if (!empty($centroids)) {
            $subjects = array_keys(current($centroids)); // Ambil nama mata pelajaran
            foreach ($subjects as $subject) {
                $row = [$subject];
                foreach ($centroids as $clusterId => $centroid) {
                    $row[] = $centroid[$subject] ?? null; // Ambil nilai centroid
                }
                $result[] = $row;
            }
        }

        // Sisipkan baris kosong sebagai pemisah
        $result[] = array_fill(0, count($result[0]), null);

        // Tambahkan heading untuk data siswa
        $result[] = [
            'No.',
            'Cluster',
            'Tahun Ajar',
            'Semester',
            'NIS',
            'Kelas',
            'Nama Siswa',
            'Agama',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'IPA',
            'IPS',
            'Matematika',
            'PJOK',
            'PKN',
            'Prakarya',
            'Seni Budaya',
            'TIK',
        ];

        // Tambahkan data siswa
        foreach ($this->data as $index => $item) {
            $result[] = [
                $index + 1,
                (string) ($item['Cluster'] ?? 0),
                substr($item['Tahun Ajar'], 0, 4) . ' / ' . substr($item['Tahun Ajar'], 4),
                $item['Semester'],
                $item['NIS'],
                $item['Kelas'],
                $item['Nama Siswa'],
                $item['NAGAMA'],
                $item['NBINDO'],
                $item['NBINGGRIS'],
                $item['NIPA'],
                $item['NIPS'],
                $item['NMATEMATIKA'],
                $item['NPJOK'],
                $item['NPKN'],
                $item['NPRAKARYA'],
                $item['NSENIBUDAYA'],
                $item['NTIK'],
            ];
        }

        return $result;
    }

    public function headings(): array
    {
        return [
            'Cluster',
            'Jumlah',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading Center
        $sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal('center');

        // Center Data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:Z' . $lastRow)->getAlignment()->setHorizontal('center');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,  // No.
            'B' => 10, // Cluster
            'C' => 16, // Tahun Ajar
            'D' => 16, // Semester
            'E' => 18, // NIS
            'F' => 10, // Kelas
            'G' => 40, // Nama Siswa
            'H' => 16, // NAGAMA
            'I' => 16, // NPKN
            'J' => 16, // NBINDO
            'K' => 16, // NMATEMATIKA
            'L' => 16, // NIPA
            'M' => 16, // NIPS
            'N' => 16, // NBINGGRIS
            'O' => 16, // NSENIBUDAYA
            'P' => 16, // NPJOK
            'Q' => 16, // NPRAKARYA
            'R' => 16, // NTIK
        ];
    }
}
