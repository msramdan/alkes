<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nomenklatur;
use Illuminate\Support\Facades\DB;
use App\Models\Faske;
use App\Models\Inventari;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LaporanLkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.create-laporan.select_nomenklatur', [
            'nomenklatur' => Nomenklatur::orderBy('nama_nomenklatur', 'ASC')->get(),
        ]);
    }

    public function create(Request $request)
    {
        $nomenklatur_id = $request->nomenklatur_id;
        $faskes = Faske::orderBy('nama_faskes', 'ASC')->get();
        //menampilkan form bagian administrasi sesuai dengan field yang sudah di config pada halaman admin
        $administrasi = DB::table('nomenklatur_pendataan_administrasi')->where('nomenklatur_id', $nomenklatur_id)->get();

        //Alat yang digunakan untuk mengisi form  bagian daftar alat ukur
        $nomenklatur_type = DB::table('nomenklatur_type')
                        ->join('types', 'nomenklatur_type.type_id', '=', 'types.id')
                        ->select('nomenklatur_type.*', 'types.jenis_alat')
                        ->where('nomenklatur_id', $nomenklatur_id)->get();

        $nomenklatur_fungsi = DB::table('nomenklatur_kondisi_fisik_fungsi')
                                ->select('*')
                                ->where('nomenklatur_id', $nomenklatur_id)
                                ->get();

        $nomenklatur_keselamatan_listrik = DB::table('nomenklatur_keselamatan_listrik')
                                              ->select('*')
                                              ->where('nomenklatur_id', $nomenklatur_id)
                                              ->get();

        $nomeklatur_telaah_teknis = DB::table('nomenklatur_telaah_teknis')
                                        ->select('*')
                                        ->where('nomenklatur_id', $nomenklatur_id)
                                        ->get();

        return view('frontend.create-laporan.create_laporan', [
            'nomenklatur_id' => $nomenklatur_id,
            'nomenklatur_type' => $nomenklatur_type,
            'faskes' => $faskes,
            'nomenklatur_fungsi' => $nomenklatur_fungsi,
            'nomenklatur_keselamatan_listrik' => $nomenklatur_keselamatan_listrik,
            'nomeklatur_telaah_teknis' => $nomeklatur_telaah_teknis
        ]);
    }

    public function submitLaporan(Request $request) {
        $laporan = Laporan::create([
            'user_created' => Session::get('id-teknisi'),
            'tgl_laporan' => Carbon::now(),
            'nomenklatur_id' => $request->nomenklatur_id,
            'status_laporan' => 'Need Review',
        ]);

        $no_laporan = 'LAP-'.date('Ymd').'-'.sprintf("%04d", $laporan->id);

        $laporan->update([
            'no_laporan' => $no_laporan
        ]);

        //Create Laporan Pendataan Administrasi
        $administrasi = $this->preg_grep_keys('/^administrasi_+(?:.+)/m', $request->input());
        $administrasi_key = array_keys($administrasi);
        foreach ($administrasi_key as $i => $administrasis) {
            $slug_administrasi = explode('_', $administrasis);

            $field_administrasi = DB::table('nomenklatur_pendataan_administrasi')
                                    ->where('slug', $slug_administrasi[1])->first();


            DB::table('laporan_pendataan_administrasi')->insert([
                'no_laporan' => $no_laporan,
                'nomenklatur_pendataan_administrasi_id' => 1,
                'value' => $_POST["{$administrasis}"]
            ]);
        }

        //Create Laporan Daftar alat ukur
        $alat_ukur = $this->preg_grep_keys('/^type-+(?:.+)/m', $request->input());
        $alat_ukur_key = array_keys($alat_ukur);

        foreach ($alat_ukur_key as $key => $alat) {
            $nomenklatur_type_id = explode('-', $alat);
            $nomenklatur_type = DB::table('nomenklatur_type')
                                ->where('id', $nomenklatur_type_id[1])
                                ->first();

            DB::table('laporan_daftar_alat_ukur')->insert([
                'no_laporan' => $no_laporan,
                'nomenklatur_type_id' => $nomenklatur_type_id[1],
                'inventaris_id' => $request->{$alat},
            ]);
        }

        //Create Laporan kondisi lingkungan
        DB::table('laporan_kondisi_lingkungan')->insert([
            'no_laporan' => $no_laporan,
            'suhu_awal' => $request->lingkungan_suhu_awal,
            'suhu_akhir' => $request->lingkungan_suhu_akhir,
            'kelembapan_ruangan_awal' => $request->lingkungan_kelembapan_ruangan_awal,
            'kelembapan_ruangan_akhir' => $request->lingkungan_kelembapan_ruangan_akhir,
        ]);

        //Create Laporan Fisik dan fungsi
        $fisik_fungsi = $this->preg_grep_keys('/^pemeriksaan_fisik_fungsi-+(?:.+)/m', $request->input());
        $fisik_fungsi_key = array_keys($fisik_fungsi);

        foreach ($fisik_fungsi_key as $a => $fisik) {
            $fisik_fungsi_id = explode('-', $fisik);
            $nomenklatur_kondisi_fisik_fungsi = DB::table('nomenklatur_kondisi_fisik_fungsi')
                                                ->where('id', $fisik_fungsi_id[1])
                                                ->first();

            DB::table('laporan_kondisi_fisik_fungsi')->insert([
                'no_laporan' => $no_laporan,
                'nomenklatur_kondisi_fisik_fungsi_id' => $nomenklatur_kondisi_fisik_fungsi->id,
                'value' => $request->{$fisik}
            ]);
        }

        //Create Laporan Keselamatan Listrik
        $keselamatan_listrik = $this->preg_grep_keys('/^keselamatan_listrik-+(?:.+)/m', $request->input());
        $keselamatan_listrik_key = array_keys($keselamatan_listrik);

        foreach ($keselamatan_listrik_key as $a => $listrik) {
            $listrik_id = explode('-', $listrik);
            $nomenklatur_keselamatan_listrik = DB::table('nomenklatur_keselamatan_listrik')
                                                ->where('id', $listrik_id[1])
                                                ->first();

            DB::table('laporan_pengukuran_keselamatan_listrik')->insert([
                'no_laporan' => $no_laporan,
                'nomenklatur_keselamatan_listrik_id' => $nomenklatur_keselamatan_listrik->id,
                'value' => $request->{$listrik}
            ]);
        }

        //Create Laporan Telaah Teknis
        $telaah_teknis = $this->preg_grep_keys('/^telaah_teknis-+(?:.+)/m', $request->input());
        $telaah_teknis_key = array_keys($telaah_teknis);

        foreach ($telaah_teknis_key as $a => $teknis) {
            $teknis_id = explode('-', $teknis);

            $nomenklatur_telaah_teknis = DB::table('nomenklatur_telaah_teknis')
                                                ->where('id', $teknis_id[1])
                                                ->first();

            DB::table('laporan_telaah_teknis')->insert([
                'no_laporan' => $no_laporan,
                'nomenklatur_telaah_teknis_id' => $nomenklatur_telaah_teknis->id,
                'value' => $request->{$teknis}
            ]);
        }

        //Create Laporan Kesimpulan Telaah Teknis
        DB::table('laporan_kesimpulan_telaah_teknis')->insert([
            'no_laporan' => $no_laporan,
            'pelaksana_pengujian' => '',
            'penyelia' => '',
            'value' => $request->kesimpulan_telaah_teknis
        ]);

        return redirect()->route('home')->with('success', 'Berhasil membuat data laporan');
    }

    private function preg_grep_keys($pattern, $input, $flags = 0) {
		return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input),$flags)));
	}
}
