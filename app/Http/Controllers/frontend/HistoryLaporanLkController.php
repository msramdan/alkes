<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Faske;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryLaporanLkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.history-laporan.index', [
            'laporan' => Laporan::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function edit($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        return view('frontend.history-laporan.edit', compact('laporan'));
    }

    public function pendataanAdministrasi($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();
        $nomenklatur_id = $laporan->nomenklatur_id;
        $pendataan_administrasi = DB::table('laporan_pendataan_administrasi')
                                    ->select("*")
                                    ->where('no_laporan', $nolaporan)
                                    ->get();

        $pendataan_administrasi = DB::table('laporan_pendataan_administrasi')
                                    ->select('*')
                                    ->where('no_laporan', $nolaporan)
                                    ->get();

        $faskes = Faske::orderBy('nama_faskes', 'ASC')->get();

        return view('frontend.history-laporan.edit.pendataan_administrasi', compact('laporan', 'pendataan_administrasi', 'faskes', 'nomenklatur_id'));
    }

    public function updatePendataanAdministrasi(Request $request)
    {
        $slugs = array_keys($request->input());

        foreach ($slugs as $slug) {
            $laporan_pendataan_administrasi = DB::table('laporan_pendataan_administrasi')
                                                ->where('slug', $slug)
                                                ->where('no_laporan', $request->no_laporan)
                                                ->update([
                                                    'value' => $request->{$slug}
                                                ]);
        }
        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function daftarAlatUkur($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();
        $nomenklatur_id = $laporan->nomenklatur_id;
        $alat_ukur = DB::table('laporan_daftar_alat_ukur')
                        ->select(
                            "laporan_daftar_alat_ukur.id",
                            "laporan_daftar_alat_ukur.no_laporan",
                            'laporan_daftar_alat_ukur.type_id',
                            "laporan_daftar_alat_ukur.inventaris_id",
                            "laporan_daftar_alat_ukur.created_at",
                            "laporan_daftar_alat_ukur.updated_at",
                            "types.jenis_alat",
                        )
                        ->join('types', 'laporan_daftar_alat_ukur.type_id', 'types.id')
                        ->where('no_laporan', $nolaporan)
                        ->get();

        return view('frontend.history-laporan.edit.daftar_alat_ukur', compact('laporan', 'nomenklatur_id', 'alat_ukur'));
    }

    public function updateAlatUkur(Request $request)
    {
        $alat_ukur = array_keys($request->input());

        foreach ($alat_ukur as $alat) {
            DB::table('laporan_daftar_alat_ukur')
                ->where('no_laporan', $request->no_laporan)
                ->where('id', $alat)
                ->update([
                    'inventaris_id' => $request->{$alat}
                ]);
        }

        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function kondisiLingkungan($nolaporan)
    {
       $laporan = Laporan::where('no_laporan', $nolaporan)->first();
       $kondisi_lingkungan = DB::table('laporan_kondisi_lingkungan')
                                ->select('*')
                                ->where('no_laporan', $nolaporan)
                                ->first();


        return view('frontend.history-laporan.edit.kondisi_lingkungan', compact('kondisi_lingkungan', 'laporan'));
    }

    public function updateKondisiLingkungan(Request $request)
    {
        $kondisi_lingkungan = DB::table('laporan_kondisi_lingkungan')
                                ->where('no_laporan', $request->nolaporan)
                                ->update([
                                    'suhu_awal' => $request->suhu_awal,
                                    'suhu_akhir' => $request->suhu_akhir,
                                    'kelembapan_ruangan_awal' => $request->kelembapan_ruangan_awal,
                                    'kelembapan_ruangan_akhir' => $request->kelembapan_ruangan_akhir,
                                ]);

        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function pemeriksaanFisikFungsi($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')
                            ->where('no_laporan', $nolaporan)
                            ->get();

        return view('frontend.history-laporan.edit.pemeriksaan_fisik_fungsi', compact('laporan', 'fisik_fungsi'));
    }

    public function updatePemeriksaanFisikFungsi(Request $request)
    {
        $datas = array_keys($request->input());

        foreach ($datas as $data) {
            $fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')
                            ->where('no_laporan', $request->no_laporan)
                            ->where('slug', $data)
                            ->update([
                                'value' => $request->{$data}
                            ]);
        }

        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function keselamatanListrik($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
                                    ->where('no_laporan', $nolaporan)
                                    ->get();

        return view('frontend.history-laporan.edit.keselamatan_listrik', compact('laporan', 'keselamatan_listrik'));
    }

    public function updateKeselamatanListrik(Request $request)
    {
        $datas = array_keys($request->input());

        foreach ($datas as $data) {
            $keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
                                ->where('no_laporan', $request->no_laporan)
                                ->where('slug', $data)
                                ->update([
                                    'value' => $request->{$data}
                                ]);
        }

        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function telaahTeknis($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $telaah_teknis = DB::table('laporan_telaah_teknis')
                            ->where('no_laporan', $nolaporan)
                            ->get();

        return view('frontend.history-laporan.edit.telaah_teknis', compact('laporan', 'telaah_teknis'));
    }

    public function updateTelaahTeknis(Request $request)
    {
        $datas = array_keys($request->input());

        foreach ($datas as $data) {
            $telaah_teknis = DB::table('laporan_telaah_teknis')
                                ->where('no_laporan', $request->no_laporan)
                                ->where('slug', $data)
                                ->update([
                                    'value' => $request->{$data}
                                ]);
        }

        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }


    public function kesimpulanTelaahTeknis($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $kesimpulan_telaah_teknis = DB::table('laporan_kesimpulan_telaah_teknis')
                                    ->where('no_laporan', $nolaporan)
                                    ->get();

        return view('frontend.history-laporan.edit.kesimpulan_telaah_teknis', compact('laporan', 'kesimpulan_telaah_teknis'));
    }

    public function updateKesimpulanTelaahTeknis(Request $request)
    {
        $kesimpulan = DB::table('laporan_kesimpulan_telaah_teknis')
                         ->where('no_laporan', $request->nolaporan)
                         ->get();

        Alert::toast('Success Update data', 'success');
        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function deleteLaporan($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->delete();
        $pendataanAdministrasi = DB::table('laporan_pendataan_administrasi')
                                    ->where('no_laporan', $nolaporan)
                                    ->delete();
        $daftarAlatUkur = DB::table('laporan_daftar_alat_ukur')
                            ->where('no_laporan', $nolaporan)
                            ->delete();
        $kondisiLingkungan = DB::table('laporan_kondisi_lingkungan')
                                ->where('no_laporan', $nolaporan)
                                ->delete();
        $pemeriksaanFisikFungsi = DB::table('laporan_kondisi_fisik_fungsi')
                                    ->where('no_laporan', $nolaporan)
                                    ->delete();
        $keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
                                ->where('no_laporan', $nolaporan)
                                ->delete();
        $telaahTeknis = DB::table('laporan_telaah_teknis')
                         ->where('no_laporan', $nolaporan)
                         ->delete();
        $kesimpulanTelaahTeknis = DB::table('laporan_kesimpulan_telaah_teknis')
                                    ->where('no_laporan', $nolaporan)
                                    ->delete();

        Alert::toast('Success Delete data', 'success');
        return redirect('/web/history_laporan/'.$nolaporan);
    }
}
