<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = "SELECT COUNT(*) AS total,faskes_id,faskes.nama_faskes FROM laporans
        JOIN faskes on faskes.id = laporans.faskes_id
        WHERE status_laporan !='Initial' GROUP BY faskes_id;";
        $fetchData= DB::select($data);
        return view('dashboard', [
            'fetchData' =>$fetchData,
        ]);
    }
}
