<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Nomenklatur;

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
        return view('frontend.create-laporan.create_laporan', [
            'nomenklatur' => Nomenklatur::orderBy('nama_nomenklatur', 'ASC')->get(),
        ]);
    }
}
