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
        //$selected_ruangan = old('ruangan') ?? $nama_ruangan;
        //dd($selected_ruangan);

        return view('frontend.inventaris', [
            'inventaris' => $inventaris,
            'allruangan' => $allruangan,
            'allmerek' => $allmerek,
            'alljenisalat' => $alljenisalat
            //'selected_ruangan' => $nama_ruangan
        ]);
    }

    public function filter()
    {
        // dd($nama_ruangan);
        //dd($filterruangan);
        // dd($selected_ruangan);
        $nama_ruangan = request()->query('nama_ruangan');

        if($nama_ruangan=="allruangan"){
            $inventaris = Inventari::with('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor')->orderBy('inventaris.id', 'DESC')->paginate(5);
        }else{
            $getid_ruangan = DB::table('rooms')->select('id')->where('nama_ruangan', $nama_ruangan)->get();
            $id_ruanganjson = strval($getid_ruangan);
            $id_ruanganjsondata = json_decode($id_ruanganjson, true);
            $id_ruangan = $id_ruanganjsondata[0]['id'];

            $selected_ruangan = old('ruangan') ?? $nama_ruangan;
            $inventaris = Inventari::with('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor')->where('inventaris.ruangan_id', $id_ruangan)->orderBy('inventaris.id', 'DESC')->paginate(5);
        }
        
        $allruangan = DB::table('rooms')->select('nama_ruangan')->get();
        $allmerek = DB::table('brands')->select('nama_merek')->get();
        $alljenisalat = DB::table('types')->select('jenis_alat')->get();

        //dd($alljenisalat);

        return view('frontend.inventaris', [
            'inventaris' => $inventaris,
            'allruangan' => $allruangan,
            'allmerek' => $allmerek,
            'alljenisalat' => $alljenisalat,
            'selected_ruangan' => $nama_ruangan
        ]);

    }
}
