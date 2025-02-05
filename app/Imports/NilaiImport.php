<?php
/***
**   ███████  █████  ███    ███ ██    ██ ███████ ██      
**   ██      ██   ██ ████  ████ ██    ██ ██      ██      
**   ███████ ███████ ██ ████ ██ ██    ██ █████   ██      
**        ██ ██   ██ ██  ██  ██ ██    ██ ██      ██      
**   ███████ ██   ██ ██      ██  ██████  ███████ ███████ 
*                                                       
*? Author : SAMUEL PRASETYO
*! Quotes : "Tetaplah berjuang untuk mencapai kesuksesanmu. 
*!           Jangan mengandalkan orang lain, karena setiap 
*!           langkah yang kamu ambil dan setiap usaha yang 
*!           kamu lakukan adalah hasil kerja kerasmu sendiri."
*/

namespace App\Imports;

use App\Models\NilaiSiswaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Validasi: Cek apakah data sudah ada
        $exists = NilaiSiswaModel::where('nis', $row['nis'])
            ->where('tahunajar', $row['tahun_ajar'])
            ->where('semester', $row['semester'])
            ->exists();

        // Jika data sudah ada, lewati proses penyimpanan
        if ($exists) {
            return null;
        }

        return new NilaiSiswaModel([
            'semester' => $row['semester'],
            'tahunajar' => $row['tahun_ajar'],
            'nis' => $row['nis'],
            'kelas' => $row['kelas'],
            'nama_siswa' => $row['nama_siswa'],
            'nagama' => $row['nagama'],
            'npkn' => $row['npkn'],
            'nbindo' => $row['nbindo'],
            'nmatematika' => $row['nmatematika'],
            'nipa' => $row['nipa'],
            'nips' => $row['nips'],
            'nbinggris' => $row['nbinggris'],
            'nsenibudaya' => $row['nsenibudaya'],
            'npjok' => $row['npjok'],
            'nprakarya' => $row['nprakarya'],
            'ntik' => $row['ntik'],
        ]);
    }
}
