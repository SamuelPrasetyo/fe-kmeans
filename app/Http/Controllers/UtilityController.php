<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{
    public function listTahunAjar()
    {
        $query = "SELECT tahunajar as value, 
                    CONCAT(SUBSTR(tahunajar, 1, 4), ' / ', SUBSTR(tahunajar, 5, 4)) as label
                FROM nilaisiswa
                GROUP BY tahunajar";

        return DB::select($query);
    }

    public function listSemester()
    {
        $query = "SELECT distinct semester FROM nilaisiswa";

        return DB::select($query);
    }
}
