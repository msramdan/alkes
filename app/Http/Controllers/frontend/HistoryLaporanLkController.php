<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Faske;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        return view('frontend.history-laporan.pendataan_administrasi', compact('laporan', 'pendataan_administrasi', 'faskes', 'nomenklatur_id'));
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

        return view('frontend.history-laporan.daftar_alat_ukur', compact('laporan', 'nomenklatur_id', 'alat_ukur'));
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

        return redirect('/web/history_laporan/'.$request->no_laporan);
    }

    public function kondisiLingkungan($nolaporan)
    {
        $kondisi_lingkungan = DB::table('laporan_kondisi_lingkungan')
                                ->select('
                                    laporan_kondisi_lingkungan.no_laporan,
                                    laporan_kondisi_lingkungan.suhu_awal,
                                    laporan_kondisi_lingkungan.suhu_akhir,
                                    laporan_kondisi_lingkungan.kelembapan_ruangan_awal,
                                    laporan_kondisi_lingkungan.kelembapan_ruangan_akhir,
                                ')
                                ->where('laporan_kondisi_lingkuan.no_laporan', $nolaporan)
                                ->get();

        return view('frontend.history-laporan.kondisi_lingkungan', compact('kondisi_lingkungan'));
    }

    public function pemeriksaanFisikFungsi($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();
        $fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')
                            ->select('
                                laporan_kondisi_fisik_fungsi.id,
                                laporan_kondisi_fisik_fungsi.no_laporan,
                                laporan_kondisi_fisik_fungsi.nomenklatur_kondisi_fisik_fungsi_id,
                                laporan_kondisi_fisik_fungsi.value,
                                laporan_kondisi_fisik_fungsi.created_at,
                                laporan_kondisi_fisik_fungsi.updated_at,
                                nomenklatur_kondisi_fisik_fungsi.nomenklatur_id,
                                nomenklatur_kondisi_fisik_fungsi.field_parameter,
                                nomenklatur_kondisi_fisik_fungsi.field_batas_pemeriksaan
                                nomenklaturs.nama_nomenklatur
                            ')
                            ->join(
                                'nomenklatur_kondisi_fisik_fungsi',
                                'laporan_kondisi_fisik_fungsi.nomenklatur_kondisi_fisik_fungsi_id',
                                'nomenklatur_kondisi_fisik_fungsi.id'
                            )
                            ->join('nomenklaturs', 'nomenklatur_kondisi_fisik_fungsi.nomenklatur_id', 'nomenklaturs.id')
                            ->where('laporan_kondisi_fisik_fungsi.no_laporan', $nolaporan)
                            ->get();

        return view('frontend.history-laporan.pemeriksaan_fisik_fungsi', compact('laporan', 'fisik_fungsi'));
    }

    public function keselamatanListrik($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
                                ->select('
                                    laporan_pengukuran_keselamatan_listrik.id,
                                    laporan_pengukuran_keselamatan_listrik.no_laporan,
                                    laporan_pengukuran_keselamatan_listrik.nomenklatur_keselamatan_listrik_id,
                                    laporan_pengukuran_keselamatan_listrik.value,
                                    laporan_pengukuran_keselamatan_listrik.created_at,
                                    laporan_pengukuran_keselamatan_listrik.updated_at
                                    nomenklatur_keselamatan_listrik.nomenklatur_id,
                                    nomenklatur_keselematan_listrik.field_keselamatan_listrik,
                                    nomenklatur_keselamatan_listrik.unit,
                                    nomenklaturs.nama_nomenklatur
                                ')
                                ->join(
                                    'nomenklatur_keselamatan_listrik',
                                    'laporan_pengukuran_keselamatan_listrik.nomenklatur_keselamatan_listrik_id',
                                    'nomenklatur_keselamatan_listrik.id'
                                )
                                ->join(
                                    'nomenklaturs',
                                    'nomenklatur_keselamatan_listrik.nomenklatur_id',
                                    'nomenklaturs.id'
                                )
                                ->where('laporan_pengukuran_keselamatan_listrik.no_laporan', $nolaporan)
                                ->get();

        return view('frontend.history-laporan.keselamatan_listrik', compact('laporan', 'keselamatan_listrik'));
    }

    public function telaahTeknis($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $telaah_teknis = DB::table('laporan_telaah_teknis')
                            ->select('
                                laporan_telaah_teknis.id,
                                laporan_telaah_teknis.no_laporan,
                                laporan_telaah_teknis.nomenklatur_telaah_teknis_id,
                                laporan_telaah_teknis.value,
                                laporan_telaah_teknis.created_at,
                                laporan_telaah_teknis.updated_at,
                                nomenklatur_telaah_teknis.nomenklatur_id,
                                nomenklatur_telaah_teknis.field_telaah_teknis,
                                nomenklaturs.nama_nomenklatur
                            ')
                            ->join(
                                'nomenklatur_telaah_teknis',
                                'laporan_telaah_teknis.nomenklatur_telaah_teknis_id',
                                'nomenklatur_telaah_teknis.id'
                            )
                            ->join(
                                'nomenklaturs',
                                'nomenklatur_telaah_teknis.nomenklatur_id',
                                'nomenklaturs.id'
                            )
                            ->where('laporan_telaah_teknis.no_laporan', $nolaporan)
                            ->get();

        return view('frontend.history-laporan.telaah_teknis', compact('laporan', 'telaah_teknis'));
    }

    public function kesimpulanTelaahTeknis($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $kesimpulan_telaah_teknis = DB::table('laporan_kesimpulan_telaah_teknis')
                                    ->select('
                                        laporan_kesimpulan_telaah_teknis.id,
                                        laporan_kesimpulan_telaah_teknis.no_laporan,
                                        laporan_kesimpulan_telaah_teknis.value,
                                        laporan_kesimpulan_telaah_teknis.created_at,
                                        laporan_kesimpulan_telaah_teknis.updated_at,
                                    ')
                                    ->where('laporan_kesimpulan_telaah_teknis.no_laporan', $nolaporan)
                                    ->get();

        return view('frontend.history-laporan.kesimpulan_telaah_teknis', compact('laporan', 'kesimpulan_telaah_teknis'));
    }

}
