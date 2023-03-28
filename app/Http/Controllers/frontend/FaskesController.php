<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaskesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faskesdata = DB::table('faskes')
            ->join('jenis_faskes', 'faskes.jenis_faskes_id', '=', 'jenis_faskes.id')
            ->join('provinces', 'faskes.provinsi_id', '=', 'provinces.id')
            ->join('kabkots', 'faskes.kabkot_id', '=', 'kabkots.id')
            ->join('kecamatans', 'faskes.kecamatan_id', '=', 'kecamatans.id')
            ->join('kelurahans', 'faskes.kelurahan_id', '=', 'kelurahans.id')
            ->select(
                'faskes.nama_faskes',
                'jenis_faskes.nama_jenis_faskes',
                'provinces.provinsi',
                'kabkots.kabupaten_kota',
                'kecamatans.kecamatan',
                'kelurahans.kelurahan',
                'alamat',
                'zip_kode'
            )
            ->paginate(5);
        return view('frontend.faskes', [
            'faskesdata' =>  $faskesdata
        ]);
    }
}
