<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClusteringExport implements FromArray, WithHeadings
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
                'Kelas' => $item['Kelas'],
                'NIS' => $item['NIS'],
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
}
