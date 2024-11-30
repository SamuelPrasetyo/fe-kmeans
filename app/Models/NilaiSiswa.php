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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswaModel extends Model
{
    protected $table = "nilaisiswa";
    protected $primaryKey = 'nis';

    protected $fillable = [
        'nis',
        'nama_siswa',
        'nama_mapel',
        'nilai',
        'link_id'
    ];

    // protected $table = "nilai_siswa";
    // protected $primaryKey = 'nis';

    // protected $fillable = [
    //     'nis',
    //     'nama_siswa',
    //     'nmatematika',
    //     'nbinggris',
    //     'nbindo',
    //     'nipa',
    //     'cluster'
    // ];
}
