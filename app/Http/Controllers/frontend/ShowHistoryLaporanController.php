<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Faske;
use Illuminate\Support\Facades\DB;

class ShowHistoryLaporanController extends Controller
{
    public function show($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $laporan_pengukuran_keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
            ->select('*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $count_laporan_pengukuran_keselamatan_listrik = count($laporan_pengukuran_keselamatan_listrik);
        return view('frontend.history-laporan.show', compact('laporan', 'count_laporan_pengukuran_keselamatan_listrik'));
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

        return view('frontend.history-laporan.show.pendataan_administrasi', compact('laporan', 'pendataan_administrasi', 'faskes', 'nomenklatur_id'));
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
                "types.jenis_alat"
            )
            ->join('types', 'laporan_daftar_alat_ukur.type_id', 'types.id')
            ->where('no_laporan', $nolaporan)
            ->get();

        return view('frontend.history-laporan.show.daftar_alat_ukur', compact('laporan', 'nomenklatur_id', 'alat_ukur'));
    }

    public function kondisiLingkungan($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();
        $kondisi_lingkungan = DB::table('laporan_kinerja')
            ->where('type_laporan_kinerja', 'laporan_kondisi_lingkungan')
            ->where('no_laporan', $nolaporan)->first();
        return view('frontend.history-laporan.show.kondisi_lingkungan', compact('kondisi_lingkungan', 'laporan'));
    }

    public function pemeriksaanFisikFungsi($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();
        $fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')
            ->where('no_laporan', $nolaporan)
            ->get();

        return view('frontend.history-laporan.show.pemeriksaan_fisik_fungsi', compact('laporan', 'fisik_fungsi'));
    }

    public function keselamatanListrik($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
            ->where('no_laporan', $nolaporan)
            ->get();

        return view('frontend.history-laporan.show.keselamatan_listrik', compact('laporan', 'keselamatan_listrik'));
    }

    public function telaahTeknis($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();

        $telaah_teknis = DB::table('laporan_telaah_teknis')
            ->where('no_laporan', $nolaporan)
            ->get();
        $kesimpulan_telaah_teknis = DB::table('laporan_kesimpulan_telaah_teknis')
            ->where('no_laporan', $nolaporan)
            ->first();

        return view('frontend.history-laporan.show.telaah_teknis', compact('laporan', 'telaah_teknis', 'kesimpulan_telaah_teknis'));
    }

    public function pengukuranKinerja($nolaporan)
    {
        $laporan = Laporan::where('no_laporan', $nolaporan)->first();
        if ($laporan->nomenklatur_id == 10 || $laporan->nomenklatur_id == 11) {
            $laporan_occlusion = DB::table('laporan_occlusion')
                ->where('no_laporan', $nolaporan)
                ->first();
            $flow_rate = DB::table('laporan_flow_rate')
                ->where('no_laporan', $nolaporan)
                ->first();
        }
        return view('frontend.history-laporan.show.pengukuran_kinjera', compact('laporan', 'laporan_occlusion', 'flow_rate'));
    }
}
