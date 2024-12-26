<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClusteringExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
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
        // Gabungkan data dan cluster ke dalam satu array untuk diekspor
        $result = [];
        foreach ($this->data as $index => $item) {
            $result[] = [
                'No' => $index + 1,
                'Cluster' => (string) ($item['Cluster'] ?? 0),
                'Tahun Ajar' => $item['Tahun Ajar'],
                'Semester' => $item['Semester'],
                'NIS' => $item['NIS'],
                'Kelas' => $item['Kelas'],
                'Nama Siswa' => $item['Nama Siswa'],
                'Agama' => $item['NAGAMA'],
                'Bahasa Indonesia' => $item['NBINDO'],
                'Bahasa Inggris' => $item['NBINGGRIS'],
                'IPA' => $item['NIPA'],
                'IPS' => $item['NIPS'],
                'Matematika' => $item['NMATEMATIKA'],
                'PJOK' => $item['NPJOK'],
                'PKN' => $item['NPKN'],
                'Prakarya' => $item['NPRAKARYA'],
                'Seni Budaya' => $item['NSENIBUDAYA'],
                'TIK' => $item['NTIK'],
            ];
        }
        return $result;
    }

    public function headings(): array
    {
        return [
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
            'TIK'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading Center
        $sheet->getStyle('A1:R1')->getAlignment()->setHorizontal('center');

        // Center Data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:Q' . $lastRow)->getAlignment()->setHorizontal('center');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,  // No.
            'B' => 8, // Cluster
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
