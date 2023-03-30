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

}
