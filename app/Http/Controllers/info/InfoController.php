<?php

namespace App\Http\Controllers\info;

use App\Http\Controllers\Controller;
use App\Models\Faske;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Alert;

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
            $getLaporan = Laporan::find($request->laporan_id);
            $pdf = Pdf::loadview('laporans/sertifikat',[
                'laporan' =>  $getLaporan
            ]);
            $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait');
            $pdf->setOption('margin-top', 0);
            $pdf->setOption('margin-right', 0);
            $pdf->setOption('margin-bottom', 0);
            $pdf->setOption('margin-left', 0);
            return $pdf->stream('laporan-sertifikat.pdf');
        } else {
            Alert::error('Error', 'The pin you entered is wrong');
            return redirect()->back();
        }
    }
}
