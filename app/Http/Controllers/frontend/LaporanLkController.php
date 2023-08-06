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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LaporanLkController extends Controller
{

    public function index()
    {
        $nomenklaturs = Nomenklatur::orderBy('id', 'DESC')->get();
        $laporan = DB::table('laporans')
            ->select('laporans.*')
            ->where('user_created', get_data_teknisi()->id)
            ->where('status_laporan', 'Initial')
            ->get();
        return view('frontend.create-laporan.select_nomenklatur', [
            'laporan' => $laporan,
            'nomenklaturs' => $nomenklaturs
        ]);
    }

    public function create(Request $request)
    {
        $step = 0;
        $laporan_id = $request->laporan_id;
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
            'step' => $step,
            'count_nomenklatur_keselamatan_listrik' => count($nomenklatur_keselamatan_listrik),
            'nomenklatur_id' => $nomenklatur_id,
            'laporan_id' => $laporan_id,
            'nomenklatur_type' => $nomenklatur_type,
            'faskes' => $faskes,
            'nomenklatur_fungsi' => $nomenklatur_fungsi,
            'nomenklatur_keselamatan_listrik' => $nomenklatur_keselamatan_listrik,
            'nomeklatur_telaah_teknis' => $nomeklatur_telaah_teknis
        ]);
    }

    public function submitLaporan(Request $request)
    {

        $laporan = Laporan::findOrFail($request->laporan_id);
        $nomenklatur = Nomenklatur::findOrFail($request->nomenklatur_id);
        $data = [
            'tgl_laporan' => Carbon::now(),
            'status_laporan' => 'Need Review',
            'faskes_id' => $_POST['administrasi_faskes-pemilik'],
            'nomenklatur_id' => $request->nomenklatur_id,
            'no_dokumen' => $nomenklatur->no_dokumen,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $laporan->update($data);
        //Create Laporan Pendataan Administrasi
        $administrasi = $this->preg_grep_keys('/^administrasi_+(?:.+)/m', $request->input());
        $administrasi_key = array_keys($administrasi);

        foreach ($administrasi_key as $i => $administrasis) {
            $slug_administrasi = explode('_', $administrasis);

            $field_administrasi = DB::table('nomenklatur_pendataan_administrasi')
                ->where('slug', $slug_administrasi[1])->first();
            DB::table('laporan_pendataan_administrasi')->insert([
                'no_laporan' => $laporan->no_laporan,
                'field_pendataan_administrasi' => $field_administrasi->field_pendataan_administrasi,
                'slug' => Str::slug($field_administrasi->field_pendataan_administrasi),
                'value' => $_POST["{$administrasis}"],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
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
                $inventaris_id = $request->{$alat};
            if ($nomenklatur_type->type_id == 39) {
                // get detail $sertifikat Thermohygrometer
                $sertifikat = DB::table('sertifikat_thermohygrometer')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                if(!$sertifikat){
                    dd('Thermohygrometer IDA belum diisi');
                }
            } else if ($nomenklatur_type->type_id == 5) {
                // get detail $sertifikat  ElectricalSafetyAnalyzer
                $ElectricalSafetyAnalyzer = DB::table('sertifikat_electrical_safety_analyzer')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                if(!$ElectricalSafetyAnalyzer){
                    dd('Sertifikat ElectricalSafetyAnalyzer belum diisi');
                }
            } else if ($nomenklatur_type->type_id == 46) {
                // get detail $sertifikat  Infusion Device Analyzer
                $sertifikatIda = DB::table('sertifikat_ida')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                if(!$sertifikatIda){
                    dd('Sertifikat IDA belum diisi');
                }
            }
            DB::table('laporan_daftar_alat_ukur')->insert([
                'no_laporan' => $laporan->no_laporan,
                'type_id' => $nomenklatur_type->type_id,
                'inventaris_id' => $request->{$alat},
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //Create Laporan kondisi lingkungan
        DB::table('laporan_kondisi_lingkungan')->insert([
            'no_laporan' => $laporan->no_laporan,
            'suhu_awal' => $request->lingkungan_suhu_awal ?: null,
            'suhu_akhir' => $request->lingkungan_suhu_akhir ?: null,
            'kelembapan_ruangan_awal' => $request->lingkungan_kelembapan_ruangan_awal ? $request->lingkungan_kelembapan_ruangan_awal :  null,
            'kelembapan_ruangan_akhir' => $request->lingkungan_kelembapan_ruangan_akhir ? $request->lingkungan_kelembapan_ruangan_akhir : null,
            'tahun' => $sertifikat->tahun,
            'uc_suhu' => $sertifikat->uc_suhu,
            'intercept_suhu' => $sertifikat->intercept_suhu,
            'x_variable_suhu' => $sertifikat->x_variable_suhu,
            'uc_kelembapan' => $sertifikat->uc_kelembapan,
            'intercept_kelembapan' => $sertifikat->intercept_kelembapan,
            'x_variable_kelembapan' => $sertifikat->x_variable_kelembapan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
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
                'no_laporan' => $laporan->no_laporan,
                'field_parameter_fisik_fungsi' => $nomenklatur_kondisi_fisik_fungsi->field_parameter,
                'field_batas_pemeriksaan' => $nomenklatur_kondisi_fisik_fungsi->field_batas_pemeriksaan,
                'value' => $request->{$fisik},
                'slug' => Str::slug($nomenklatur_kondisi_fisik_fungsi->field_parameter),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
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
                'no_laporan' => $laporan->no_laporan,
                'field_keselamatan_listrik' => $nomenklatur_keselamatan_listrik->field_keselamatan_listrik,
                'value' => $request->{$listrik},
                'slug' => Str::slug($nomenklatur_keselamatan_listrik->field_keselamatan_listrik),
                'tahun' => $ElectricalSafetyAnalyzer->tahun,
                'intercept1' => $ElectricalSafetyAnalyzer->intercept1,
                'x_variable1' => $ElectricalSafetyAnalyzer->x_variable1,
                'intercept2' => $ElectricalSafetyAnalyzer->intercept2,
                'x_variable2' => $ElectricalSafetyAnalyzer->x_variable2,
                'intercept3' => $ElectricalSafetyAnalyzer->intercept3,
                'x_variable3' => $ElectricalSafetyAnalyzer->x_variable3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // create laporan kinerja
        // INFUSION PUMP & SYRINGE PUMP
        if ($request->nomenklatur_id == 10 || $request->nomenklatur_id == 11) {
            DB::table('laporan_occlusion')->insert([
                'no_laporan' => $laporan->no_laporan,
                'percobaan_1' => $request->percobaan_1,
                'percobaan_2' => $request->percobaan_2,
                'percobaan_3' => $request->percobaan_3,
                'percobaan_4' => $request->percobaan_4,
                'percobaan_5' => $request->percobaan_5,
                'percobaan_6' => $request->percobaan_6,
            ]);

            DB::table('laporan_flow_rate')->insert([
                'no_laporan' => $laporan->no_laporan,
                'percobaan1_1' => $request->percobaan1_1,
                'percobaan1_2' => $request->percobaan1_2,
                'percobaan1_3' => $request->percobaan1_3,
                'percobaan1_4' => $request->percobaan1_4,
                'percobaan1_5' => $request->percobaan1_5,
                'percobaan1_6' => $request->percobaan1_6,
                'percobaan2_1' => $request->percobaan2_1,
                'percobaan2_2' => $request->percobaan2_2,
                'percobaan2_3' => $request->percobaan2_3,
                'percobaan2_4' => $request->percobaan2_4,
                'percobaan2_5' => $request->percobaan2_5,
                'percobaan2_6' => $request->percobaan2_6,
                'percobaan3_1' => $request->percobaan3_1,
                'percobaan3_2' => $request->percobaan3_2,
                'percobaan3_3' => $request->percobaan3_3,
                'percobaan3_4' => $request->percobaan3_4,
                'percobaan3_5' => $request->percobaan3_5,
                'percobaan3_6' => $request->percobaan3_6,
                'percobaan4_1' => $request->percobaan4_1,
                'percobaan4_2' => $request->percobaan4_2,
                'percobaan4_3' => $request->percobaan4_3,
                'percobaan4_4' => $request->percobaan4_4,
                'percobaan4_5' => $request->percobaan4_5,
                'percobaan4_6' => $request->percobaan4_6,
                // sertifikat ida
                'tahun' => $sertifikatIda->tahun,
                'slope_1' => $sertifikatIda->slope_1,
                'intercept_1' => $sertifikatIda->intercept_1,
                'slope_2' => $sertifikatIda->slope_2,
                'intercept_2' => $sertifikatIda->intercept_2,
                'drift10_1' => $sertifikatIda->drift10_1,
                'drift50_1' => $sertifikatIda->drift50_1,
                'drift100_1' => $sertifikatIda->drift100_1,
                'drift500_1' => $sertifikatIda->drift500_1,
                'drift10_2' => $sertifikatIda->drift10_2,
                'drift50_2' => $sertifikatIda->drift50_2,
                'drift100_2' => $sertifikatIda->drift100_2,
                'drift500_2' => $sertifikatIda->drift500_2,
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
                'no_laporan' => $laporan->no_laporan,
                'field_telaah_teknis' => $nomenklatur_telaah_teknis->field_telaah_teknis,
                'slug' => Str::slug($nomenklatur_telaah_teknis->field_telaah_teknis),
                'value' => $request->{$teknis},
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //Create Laporan Kesimpulan Telaah Teknis
        DB::table('laporan_kesimpulan_telaah_teknis')->insert([
            'no_laporan' => $laporan->no_laporan,
            'catatan' => $request->catatan_kesimpulan_telaah_teknis,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        toast('Berhasil membuat data laporan', 'success');
        return redirect()->route('home');
    }

    private function preg_grep_keys($pattern, $input, $flags = 0)
    {
        return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
    }
}
