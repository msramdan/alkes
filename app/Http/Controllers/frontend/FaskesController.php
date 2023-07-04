<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faske;
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
        $faskesdata = Faske::with('jenis_faske:id,nama_jenis_faskes', 'province:id,provinsi',
        'kabkot:id,kabupaten_kota','kecamatan:id,kecamatan','kelurahan:id,kelurahan')
            ->orderBy('faskes.id', 'DESC')->paginate(5);

        $alljenis_faskes = DB::table('jenis_faskes')->select('nama_jenis_faskes')->get();
        $allkabkots = DB::table('kabkots')->select('kabupaten_kota')->get();

        return view('frontend.faskes', [
            'faskesdata' =>  $faskesdata,
            'alljenis_faskes' =>  $alljenis_faskes,
            'allkabkots' =>  $allkabkots,
            'selected_jenisfaskes' => 'alljenisfaskes',
            'selected_kabkot' => 'allkabkot',
            'selected_short' => 'def'
        ]);
    }

    private function getFaskes($jenisfaskes, $kabkot, $short) {
        if($short=="def"){
            $faskesdata = Faske::with('jenis_faske:id,nama_jenis_faskes', 'province:id,provinsi',
            'kabkot:id,kabupaten_kota','kecamatan:id,kecamatan','kelurahan:id,kelurahan')
            ->orderBy('faskes.nama_faskes', 'ASC');
        }else{
            $faskesdata = Faske::with('jenis_faske:id,nama_jenis_faskes', 'province:id,provinsi',
            'kabkot:id,kabupaten_kota','kecamatan:id,kecamatan','kelurahan:id,kelurahan')
            ->orderBy('faskes.nama_faskes', $short);
        }
        if ($jenisfaskes != "alljenisfaskes") {
            $getid_jenisfaskes = DB::table('jenis_faskes')->select('id')->where('nama_jenis_faskes', $jenisfaskes)->get();
            $id_jenisfaskesjson = strval($getid_jenisfaskes);
            $id_jenisfaskesjsondata = json_decode($id_jenisfaskesjson, true);
            $id_jenisfaskes = $id_jenisfaskesjsondata[0]['id'];

            // $selected_jenisfaskes = old('jenisfaskes') ?? $jenisfaskes;

            $faskesdata->where('faskes.jenis_faskes_id', $id_jenisfaskes);
        }
        if ($kabkot != "allkabkot") {
            $getid_kabkot = DB::table('kabkots')->select('id')->where('kabupaten_kota', $kabkot)->get();
            $id_kabkotjson = strval($getid_kabkot);
            $id_kabkotjsondata = json_decode($id_kabkotjson, true);
            $id_kabkot = $id_kabkotjsondata[0]['id'];
            $faskesdata->where('faskes.kabkot_id', $id_kabkot);
        }
        return $faskesdata->orderBy('faskes.nama_faskes', $short == "def" ? "ASC" : $short)->paginate(5);

    }

    public function filter()
    {
        $nama_jenisfaskes = request()->query('nama_jenisfaskes') ?? 'alljenisfaskes';
        $nama_kabkot = request()->query('nama_kabkot') ?? 'allkabkot';
        $nama_short = request()->query('sorting') ?? 'def';
        $faskesdata = $this->getFaskes($nama_jenisfaskes, $nama_kabkot, $nama_short);
        $alljenis_faskes = DB::table('jenis_faskes')->select('nama_jenis_faskes')->get();
        $allkabkots = DB::table('kabkots')->select('kabupaten_kota')->get();

        return view('frontend.faskes', [
            'faskesdata' =>  $faskesdata,
            'alljenis_faskes' =>  $alljenis_faskes,
            'allkabkots' =>  $allkabkots,
            'selected_jenisfaskes' => $nama_jenisfaskes,
            'selected_kabkot' => $nama_kabkot,
            'selected_short' => $nama_short
        ]);

    }
}
