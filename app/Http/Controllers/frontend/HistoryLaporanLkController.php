<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class HistoryLaporanLkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.history-laporan.index', [
            'laporan' => Laporan::orderBy('id', 'DESC')->get(),
        ]);
    }

}
