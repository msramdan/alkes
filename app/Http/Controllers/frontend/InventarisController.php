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
        // dd($inventaris);
        $allruangan = DB::table('rooms')->select('nama_ruangan')->get();
        $allmerek = DB::table('brands')->select('nama_merek')->get();
        $alljenisalat = DB::table('types')->select('jenis_alat')->get();

        return view('frontend.inventaris', [
            'inventaris' => $inventaris,
            'allruangan' => $allruangan,
            'allmerek' => $allmerek,
            'alljenisalat' => $alljenisalat,
            'selected_ruangan' => 'allruangan',
            'selected_merek' => 'allmerek',
            'selected_jenis_alat' => 'selectjenisalat'
        ]);
    }

    private function getInventaris($ruangan, $merek, $jenisalat) {
        $inventaris = Inventari::with('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor')
            ->orderBy('inventaris.id', 'DESC');
    
        if ($ruangan != "allruangan") {
            $getid_ruangan = DB::table('rooms')->select('id')->where('nama_ruangan', $ruangan)->get();
            $id_ruanganjson = strval($getid_ruangan);
            $id_ruanganjsondata = json_decode($id_ruanganjson, true);
            $id_ruangan = $id_ruanganjsondata[0]['id'];
    
            $selected_ruangan = old('ruangan') ?? $ruangan;
    
            $inventaris->where('inventaris.ruangan_id', $id_ruangan);
        }
    
        if ($merek != "allmerek") {
            $getid_merek = DB::table('brands')->select('id')->where('nama_merek', $merek)->get();
            $id_merekjson = strval($getid_merek);
            $id_merekjsondata = json_decode($id_merekjson, true);
            $id_merek = $id_merekjsondata[0]['id'];
    
            $selected_merek = old('merek') ?? $merek;
    
            $inventaris->where('inventaris.merk_id', $id_merek);
        }

        if ($jenisalat != "alljenisalat") {
            $getid_jenisalat = DB::table('types')->select('id')->where('jenis_alat', $jenisalat)->get();
            $id_jenisalatjson = strval($getid_jenisalat);
            $id_jenisalatjsondata = json_decode($id_jenisalatjson, true);
            $id_jenisalat = $id_jenisalatjsondata[0]['id'];
    
            $selected_jenis_alat = old('jenisalat') ?? $jenisalat;
    
            $inventaris->where('inventaris.jenis_alat_id', $id_jenisalat);
        }
    
        return $inventaris->paginate(5);
    }

    public function filter()
    {
        $nama_ruangan = request()->query('nama_ruangan') ?? 'allruangan';
        $nama_merek = request()->query('nama_merek') ?? 'allmerek';
        $nama_jenisalat = request()->query('nama_jenisalat') ?? 'alljenisalat';

        $inventaris = $this->getInventaris($nama_ruangan, $nama_merek, $nama_jenisalat);      
        
        $allruangan = DB::table('rooms')->select('nama_ruangan')->get();
        $allmerek = DB::table('brands')->select('nama_merek')->get();
        $alljenisalat = DB::table('types')->select('jenis_alat')->get();

        return view('frontend.inventaris', [
            'inventaris' => $inventaris,
            'allruangan' => $allruangan,
            'allmerek' => $allmerek,
            'alljenisalat' => $alljenisalat,
            'selected_ruangan' => $nama_ruangan,
            'selected_merek' => $nama_merek,
            'selected_jenis_alat' => $nama_jenisalat
        ]);

    }
}
