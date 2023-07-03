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
        $data = [
            'tgl_laporan' => Carbon::now(),
            'status_laporan' => 'Need Review',
            'faskes_id' => $_POST['administrasi_faskes-pemilik'],
            'nomenklatur_id' => $request->nomenklatur_id,
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
            // Thermohygrometer
            if ($nomenklatur_type->type_id == 39) {
                // get detail $sertifikat
                $inventaris_id = $request->{$alat};
                $sertifikat = DB::table('sertifikat_thermohygrometer')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
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
            'tahun' => isset($sertifikat->tahun),
            'uc_suhu' => isset($sertifikat->uc_suhu),
            'intercept_suhu' => isset($sertifikat->intercept_suhu),
            'x_variable_suhu' => isset($sertifikat->x_variable_suhu),
            'uc_kelembapan' => isset($sertifikat->uc_kelembapan),
            'intercept_kelembapan' => isset($sertifikat->intercept_kelembapan),
            'x_variable_kelembapan' => isset($sertifikat->x_variable_kelembapan),
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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
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
