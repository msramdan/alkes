<?php

namespace App\Http\Controllers\info;

use App\Http\Controllers\Controller;
use App\Models\Faske;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Alert;
use App\Models\Nomenklatur;

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
            $laporan = DB::table('laporans')
                ->join('pelaksana_teknisis', 'laporans.user_created', '=', 'pelaksana_teknisis.id')
                ->leftjoin('users', 'laporans.user_review', '=', 'users.id')
                ->select('laporans.*', 'pelaksana_teknisis.nama as nama_teknisi', 'users.name as name_user')
                ->where('laporans.id', $request->laporan_id)
                ->first();
            $faskes = Faske::findOrFail($laporan->faskes_id);
            $nomenklatur = Nomenklatur::findOrFail($laporan->nomenklatur_id);
            $merk = DB::table('laporan_pendataan_administrasi')
                ->where('no_laporan', $laporan->no_laporan)
                ->where('field_pendataan_administrasi', 'Merk')
                ->first();
            $sn = DB::table('laporan_pendataan_administrasi')
                ->where('no_laporan', $laporan->no_laporan)
                ->where('field_pendataan_administrasi', 'Nomor Seri')
                ->first();

            // $laporan_pendataan_administrasi =
            //     DB::table('laporan_pendataan_administrasi')
            //     ->join('nomenklatur_pendataan_administrasi', 'laporan_pendataan_administrasi.slug', '=', 'nomenklatur_pendataan_administrasi.slug')
            //     ->select('laporan_pendataan_administrasi.*', 'nomenklatur_pendataan_administrasi.satuan',)
            //     ->where('no_laporan', $laporan->no_laporan)
            //     ->where('nomenklatur_id', $laporan->nomenklatur_id)
            //     ->get();

            // $dataAwal = ceil(count($laporan_pendataan_administrasi) / 2);
            // $laporan_daftar_alat_ukur =
            //     DB::table('laporan_daftar_alat_ukur')
            //     ->join('inventaris', 'laporan_daftar_alat_ukur.inventaris_id', '=', 'inventaris.id')
            //     ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            //     ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            //     ->select('inventaris.*', 'brands.nama_merek', 'types.jenis_alat')
            //     ->where('no_laporan', $laporan->no_laporan)
            //     ->get();
            // $laporan_telaah_teknis =
            //     DB::table('laporan_telaah_teknis')
            //     ->select('laporan_telaah_teknis.*')
            //     ->where('no_laporan', $laporan->no_laporan)
            //     ->get();
            // $laporan_kesimpulan_telaah_teknis =
            //     DB::table('laporan_kesimpulan_telaah_teknis')
            //     ->select('laporan_kesimpulan_telaah_teknis.*')
            //     ->where('no_laporan', $laporan->no_laporan)
            //     ->first();
            // $laporan_kondisi_lingkungan = DB::table('laporan_kinerja')
            //     ->where('type_laporan_kinerja', 'laporan_kondisi_lingkungan')
            //     ->where('no_laporan', $laporan->no_laporan)->first();
            $kondisi_fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')->where('no_laporan', $laporan->no_laporan)->get();
            $laporan_pengukuran_keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
                ->select('*')
                ->where('no_laporan', $laporan->no_laporan)
                ->get();
            $count_laporan_pengukuran_keselamatan_listrik = count($laporan_pengukuran_keselamatan_listrik);

            $kondisi_fisik_fungsi_baik = DB::table('laporan_kondisi_fisik_fungsi')
                ->where('no_laporan', $laporan->no_laporan)
                ->where('value', 'baik')->get();

            $score_fisik = (count($kondisi_fisik_fungsi_baik) / count($kondisi_fisik_fungsi)) * 10;


            $pdf = Pdf::loadview('laporans/sertifikat', [
                'laporan' =>  $laporan,
                'faskes' =>  $faskes,
                'nomenklatur' =>  $nomenklatur,
                'merk' =>  $merk->value,
                'sn' =>  $sn->value,
                'tgl' => substr($laporan->tgl_review, 0, 10),
                // 'laporan_pendataan_administrasi' => $laporan_pendataan_administrasi,
                // 'dataAwal' => $dataAwal,
                // 'laporan_daftar_alat_ukur' => $laporan_daftar_alat_ukur,
                'kondisi_fisik_fungsi' => $kondisi_fisik_fungsi,
                // 'laporan_kondisi_lingkungan' => $laporan_kondisi_lingkungan,
                // 'laporan_telaah_teknis' => $laporan_telaah_teknis,
                // 'laporan_kesimpulan_telaah_teknis' => $laporan_kesimpulan_telaah_teknis,
                // 'laporan_pengukuran_keselamatan_listrik' => $laporan_pengukuran_keselamatan_listrik,
                'count_laporan_pengukuran_keselamatan_listrik' => $count_laporan_pengukuran_keselamatan_listrik,
                'score_fisik' => round($score_fisik, 2),

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
