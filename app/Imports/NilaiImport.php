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

use App\Models\NilaiSiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class NilaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (NilaiSiswa::where('nis', $row[1])->exists()) {
            return null; // Lewati data jika 'nis' sudah ada
        }

        return new NilaiSiswa([
            'nis' => $row[1],
            'nama_siswa' => $row[2],
            'nama_mapel' => $row[3],
            'nilai' => $row[4],
            'link_id' => $row[5]
        ]);
    }
}
