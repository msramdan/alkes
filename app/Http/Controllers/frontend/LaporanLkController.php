<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Nomenklatur;
use Illuminate\Support\Facades\DB;

class LaporanLkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.create-laporan.select_nomenklatur', [
            'nomenklatur' => Nomenklatur::orderBy('nama_nomenklatur', 'ASC')->get(),
        ]);
    }

    public function create()
    {
        $nomenklatur_id = $_GET['nomenklatur_id'];
        $administrasi = DB::table('nomenklatur_pendataan_administrasi')->where('nomenklatur_id', $nomenklatur_id)->get();
        return view('frontend.create-laporan.create_laporan', [
            'nomenklatur_id' => $nomenklatur_id,
        ]);
    }
}
