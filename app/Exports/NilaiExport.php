<?php

namespace App\Exports;

use App\Models\NilaiSiswaModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NilaiExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return NilaiSiswaModel::select(
            'idnilai',
            'semester',
            'tahunajar',
            'nis',
            'kelas',
            'nama_siswa',
            'nagama',
            'npkn',
            'nbindo',
            'nmatematika',
            'nipa',
            'nips',
            'nbinggris',
            'nsenibudaya',
            'npjok',
            'nprakarya',
            'ntik'
        )->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Semester',
            'Tahun Ajar',
            'NIS',
            'Kelas',
            'Nama Siswa',
            'NAGAMA',
            'NPKN',
            'NBINDO',
            'NMATEMATIKA',
            'NIPA',
            'NIPS',
            'NBINGGRIS',
            'NSENIBUDAYA',
            'NPJOK',
            'NPRAKARYA',
            'NTIK'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading Center
        $sheet->getStyle('A1:Q1')->getAlignment()->setHorizontal('center');

        // Center Data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:Q' . $lastRow)->getAlignment()->setHorizontal('center');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,  // No.
            'B' => 14, // Semester
            'C' => 14, // Tahun Ajar
            'D' => 18, // NIS
            'E' => 10, // Kelas
            'F' => 40, // Nama Siswa
            'G' => 14, // NAGAMA
            'H' => 14, // NPKN
            'I' => 14, // NBINDO
            'J' => 14, // NMATEMATIKA
            'K' => 14, // NIPA
            'L' => 14, // NIPS
            'M' => 14, // NBINGGRIS
            'N' => 14, // NSENIBUDAYA
            'O' => 14, // NPJOK
            'P' => 14, // NPRAKARYA
            'Q' => 14, // NTIK
        ];
    }
}
