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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSiswaModel extends Model
{
    protected $table = "nilaisiswa";
    protected $primaryKey = 'idnilai';

    protected $fillable = [
        'idnilai',
        'semester',
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
        'ntik',
    ];
}
