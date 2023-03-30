<?php

namespace App\Http\Controllers\frontend;

use App\Models\Nomenklatur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'nomenklatur' => Nomenklatur::orderBy('id', 'DESC')->paginate(5),
        ]);
    }

    // $Metodekerja = Nomenklatur::query()->paginate(5);
    // return view('frontend.listmetodekerja', [
    //     'metodekerja' => $Metodekerja
    // ]

    public function getDownload($file, $name)
    {
        $newName = 'Metode Kerja ' . $name . '.pdf';
        return response()->download(public_path('storage/img/metode_kerja/' . $file), $newName);
    }
}
