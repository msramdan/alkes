<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Nomenklatur;
use Illuminate\Support\Facades\DB;
use App\Models\Faske;
use App\Models\Inventari;
use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
        $nomenklatur_id = $request->nomenklatur_id;
        $faskes = Faske::orderBy('nama_faskes', 'ASC')->get();
        //menampilkan form bagian administrasi sesuai dengan field yang sudah di config pada halaman admin
        $administrasi = DB::table('nomenklatur_pendataan_administrasi')->where('nomenklatur_id', $nomenklatur_id)->get();

        //Alat yang digunakan untuk mengisi form  bagian daftar alat ukur
        $nomenklatur_type = DB::table('nomenklatur_type')
                        ->join('types', 'nomenklatur_type.type_id', '=', 'types.id')
                        ->select('nomenklatur_type.*', 'types.jenis_alat')
                        ->where('nomenklatur_id', $nomenklatur_id)->get();

        $nomenklatur_fungsi = DB::table('nomenklatur_kondisi_fisik_fungsi')
                                ->select('*')
                                ->where('nomenklatur_id', $nomenklatur_id)
                                ->get();

        $nomenklatur_keselamatan_listrik = DB::table('nomenklatur_keselamatan_listrik')
                                              ->select('*')
                                              ->where('nomenklatur_id', $nomenklatur_id)
                                              ->get();

        $nomeklatur_telaah_teknis = DB::table('nomenklatur_telaah_teknis')
                                        ->select('*')
                                        ->where('nomenklatur_id', $nomenklatur_id)
                                        ->get();

        return view('frontend.create-laporan.create_laporan', [
            'nomenklatur_id' => $nomenklatur_id,
            'nomenklatur_type' => $nomenklatur_type,
            'faskes' => $faskes,
            'nomenklatur_fungsi' => $nomenklatur_fungsi,
            'nomenklatur_keselamatan_listrik' => $nomenklatur_keselamatan_listrik,
            'nomeklatur_telaah_teknis' => $nomeklatur_telaah_teknis
        ]);
    }
}
