<?php

namespace App\Http\Controllers\frontend;

use App\Models\MetodeKerja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nomenklatur;

class MetodeKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.listmetodekerja', [
            'nomenklatur' => Nomenklatur::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function getDownload($file, $name)
    {
        $newName = 'Metode Kerja ' . $name . '.pdf';
        return response()->download(public_path('storage/img/metode_kerja/' . $file), $newName);
    }
}
