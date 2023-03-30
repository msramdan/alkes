<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventari;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventaris = Inventari::with('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor')->orderBy('inventaris.id', 'DESC')->paginate(5);
        $allruangan = DB::table('rooms')->select('nama_ruangan')->get();
        $allmerek = DB::table('brands')->select('nama_merek')->get();
        $alljenisalat = DB::table('types')->select('jenis_alat')->get();

        //dd($alljenisalat);

        return view('frontend.inventaris', [
            'inventaris' => $inventaris,
            'allruangan' => $allruangan,
            'allmerek' => $allmerek,
            'alljenisalat' => $alljenisalat
        ]);
    }
}
