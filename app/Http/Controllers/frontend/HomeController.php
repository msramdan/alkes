<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BannerManagement;
use App\Models\Home;
use App\Models\Faske;
use App\Models\JenisFaske;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\KontakMasukan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home', [
            'banner' => BannerManagement::orderBy('posisi', 'ASC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('frontend.profile');
    }
    public function kontak()
    {
        return view('frontend.kontak');
    }
    

    public function store_kontak(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required|string|max:200',
                'deksiprsi' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $pesan = KontakMasukan::create([
            'pelaksana_teknis_id'   => $request->pelaksana_teknis_id,
            'judul'   => $request->judul,
            'deksiprsi'   => $request->deksiprsi,
        ]);
        if ($pesan) {
            toast('Terima kasih telah menghubungi kami.', 'success');
            return redirect()->route('web-kontak');
        }
    }

    public function faskes()
    {
        // $data = [
        //     "title" => "Home",
        //     "posts" => Home::all()
        // ];

        $faskesdata = DB::table('faskes')
            ->join('jenis_faskes', 'faskes.jenis_faskes_id', '=', 'jenis_faskes.id')
            ->join('provinces', 'faskes.provinsi_id', '=', 'provinces.id')
            ->join('kabkots', 'faskes.kabkot_id', '=', 'kabkots.id')
            ->join('kecamatans', 'faskes.kecamatan_id', '=', 'kecamatans.id')
            ->join('kelurahans', 'faskes.kelurahan_id', '=', 'kelurahans.id')
            ->select('faskes.nama_faskes', 'jenis_faskes.nama_jenis_faskes', 'provinces.provinsi', 
            'kabkots.kabupaten_kota','kecamatans.kecamatan','kelurahans.kelurahan','alamat','zip_kode')
            ->get();
        
        //dd($faskesdata);
        return view('frontend.faskes',[
            'faskesdata' =>  $faskesdata
        ]);
        
        //return view('frontend.faskes', $faskesdata);
    }
    public function inventaris()
    {
        return view('frontend.inventaris');
    }
    public function listmetodekerja()
    {
        return view('frontend.listmetodekerja');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}
