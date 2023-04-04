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
            'filternomenklatur' => Nomenklatur::orderBy('id', 'DESC')->paginate(5),
            'nomenklatur' => Nomenklatur::orderBy('id', 'DESC')->paginate(5)
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

    public function filter()
    {
        $nomenklatur_id = $_GET['nomenklatur_id'];

        if($nomenklatur_id == "allnomenklatur"){
            $filternomenklatur = Nomenklatur::orderBy('id', 'DESC')->paginate(5);
        }else{
            $filternomenklatur = Nomenklatur::where('id', $nomenklatur_id)->get();
        }

        $nomenklatur = Nomenklatur::orderBy('id', 'DESC')->paginate(5);

        return view('frontend.listmetodekerja', [
            'filternomenklatur' => $filternomenklatur,
            'nomenklatur' => $nomenklatur
        ]);
    }

}
