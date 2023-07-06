<?php

namespace App\Http\Controllers\info;

use App\Http\Controllers\Controller;
use App\Models\Faske;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
Use Alert;

class InfoController extends Controller
{

    public function sertifikat($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('info.sertifikat', [
            'laporan' =>  $laporan
        ]);
    }

    public function info_inventaris($id)
    {
        $inventaris
            = DB::table('inventaris')
            ->join('rooms', 'inventaris.ruangan_id', '=', 'rooms.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->join('vendors', 'inventaris.vendor_id', '=', 'vendors.id')
            ->select('inventaris.*', 'rooms.nama_ruangan', 'brands.nama_merek', 'types.jenis_alat', 'vendors.nama_vendor')
            ->where('inventaris.id', $id)->first();
        return view('info.info_inventaris', [
            'inventaris' => $inventaris,
        ]);
    }

    public function download_e_sertifikat(Request $request)
    {
        $faskes = Faske::findOrFail($request->faskes_id);
        $satu = $request->satu;
        $dua = $request->dua;
        $tiga = $request->tiga;
        $empat = $request->empat;
        $lima = $request->lima;
        $enam = $request->enam;
        $fix = $satu . '' . $dua . '' . $tiga . '' . $empat . '' . $lima . '' . $enam;
        if ($faskes->pin == $fix) {
            $pdf = PDF::loadview('info.download_sertifikat', []);
            return $pdf->stream();
        }else{
            Alert::error('Error', 'The pin you entered is wrong');
            return redirect()->back();
        }
    }
}
