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
        try {
            // Memulai transaksi database
            DB::beginTransaction();

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
                if ($nomenklatur_type->type_id == config('type_inventaris.Thermohygrometer')) {
                    // get detail $sertifikat Thermohygrometer
                    $sertifikat = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikat) {
                        dd('Thermohygrometer belum diisi');
                    }
                } else if ($nomenklatur_type->type_id ==  config('type_inventaris.Electrical_Safety_Analyzer')) {
                    $ElectricalSafetyAnalyzer = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$ElectricalSafetyAnalyzer) {
                        dd('Sertifikat ElectricalSafetyAnalyzer belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.InfusionDeviceAnalyzer')) {
                    // get detail $sertifikat  Infusion Device Analyzer
                    $sertifikatIda = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikatIda) {
                        dd('Sertifikat IDA belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.DigitalStopWatch')) {
                    // get detail $sertifikat  Digital Stop Watch
                    $sertifikatDigitalStopWatch = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikatDigitalStopWatch) {
                        dd('Digital Stop Watch belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.ContactTachometer')) {
                    $sertifikatTachometer = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikatTachometer) {
                        dd('sertifikatTachometer belum diisi');
                    }
                } else if ($nomenklatur_type->type_id ==  config('type_inventaris.DigitalPressureMeter')) {
                    // get detail $sertifikat 	Digital Pressure Meter
                    $sertifikatDpm = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikatDpm) {
                        dd('Digital Pressure Meter belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.TemperatureRecorder')) {
                    // get detail Temperature Recorder
                    $sertifikatTemperatureRecorder = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikatTemperatureRecorder) {
                        dd('Digital Pressure Meter belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.FETAL_SIMULATOR')) {
                    // get detail Fetal Simulator
                    $fetalSimulator = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$fetalSimulator) {
                        dd('Fetal Simulator belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.LUX_METER')) {
                    $luxMeter = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$luxMeter) {
                        dd('luxMeter belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.Solar_Power_Meter')) {
                    $solarPowerPanel = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$solarPowerPanel) {
                        dd('solarPowerPanel belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.Ventilator_Analyzer')) {
                    $ventilatorAnalyzer = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$ventilatorAnalyzer) {
                        dd('ventilatorAnalyzer belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.SPO2_Simulator')) {
                    $spo2_Simulator = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$spo2_Simulator) {
                        dd('spo2_Simulator belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.Phototherapy_Radiometer')) {
                    $phototherapyRadiometer = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$phototherapyRadiometer) {
                        dd('phototherapyRadiometer belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.ForceGauge')) {
                    $ForceGauge = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$ForceGauge) {
                        dd('sertifikat ForceGauge belum diisi');
                    }
                } else if ($nomenklatur_type->type_id == config('type_inventaris.UvRadiometer')) {
                    $sertifikatUvRadiometer = DB::table('sertifikat_inventaris')->orderBy('tahun', 'desc')->where('inventaris_id', $inventaris_id)->first();
                    if (!$sertifikatUvRadiometer) {
                        dd('sertifikat ForceGauge belum diisi');
                    }
                }
                DB::table('laporan_daftar_alat_ukur')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_id' => $nomenklatur_type->type_id,
                    'inventaris_id' => $request->{$alat},
                ]);
            }

            //Create Laporan kondisi lingkungan
            DB::table('laporan_kinerja')->insert([
                'no_laporan' => $laporan->no_laporan,
                'type_laporan_kinerja' => 'laporan_kondisi_lingkungan',
                'data_laporan' => laporan_kondisi_lingkungan($request),
                'data_sertifikat' =>  $sertifikat->data,
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
                    'data_sertifikat' => $ElectricalSafetyAnalyzer->data,
                ]);
            }

            if ($request->nomenklatur_id == config('nomenklatur.INFUSION_PUMP') || $request->nomenklatur_id == config('nomenklatur.SYRINGE_PUMP')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'laporan_occlusion',
                    'data_laporan' => laporan_occlusion($request),
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'laporan_flow_rate',
                    'data_laporan' => laporan_flow_rate($request),
                    'data_sertifikat' => $sertifikatIda->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.SPHYGMOMANOMETER')) {
                // simpan KEBOCORAN TEKANAN
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'kebocoran_tekanan',
                    'data_laporan' => kebocoran_tekanan($request),
                ]);
                // simpan LAJU BUANG CEPAT
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'laju_buang_cepat',
                    'data_laporan' => laju_buang_cepat($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
                // simpan KALIBRASI AKURASI TEKANAN
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'akurasi_tekanan',
                    'data_laporan' => akurasi_tekanan($request),
                    'data_sertifikat' => $sertifikatDpm->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.INKUBATOR_LABORATORIUM')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'sensor_recorder',
                    'data_laporan' => sensor_recorder($request),
                    'data_sertifikat' => $sertifikatTemperatureRecorder->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.SUCTION_PUMP')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'suction_pump',
                    'data_laporan' => suction_pump($request),
                    'data_sertifikat' => $sertifikatDpm->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.CENTRIFUGE')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'contact_tachometer',
                    'data_laporan' => contact_tachometer($request),
                    'data_sertifikat' => $sertifikatTachometer->data,
                ]);
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'kinerja_waktu',
                    'data_laporan' => kinerja_waktu($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.ELECTROCARDIOGRAPH')) {
            } else if ($request->nomenklatur_id == config('nomenklatur.CARDIOTOCOGRAPH')) {
                // HEART RATE
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'heart_rate',
                    'data_laporan' => heart_rate($request),
                    'data_sertifikat' => $fetalSimulator->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.FETAL_DOPPLER')) {
                // HEART RATE
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'heart_rate',
                    'data_laporan' => heart_rate($request),
                    'data_sertifikat' => $fetalSimulator->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.DENTAL_UNIT')) {
                // Intensitas Cahaya
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'intensitas_cahaya',
                    'data_laporan' => intensitas_cahaya($request),
                    'data_sertifikat' => $luxMeter->data,
                ]);
                // Akurasi Pressure
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'akurasi_pressure',
                    'data_laporan' => akurasi_pressure($request),
                    'data_sertifikat' => $sertifikatDpm->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.ROLLER_MIXER') || $request->nomenklatur_id == config('nomenklatur.ROTATOR')) {
                // KECEPATAN PUTAR
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'kecepatan_putaran',
                    'data_laporan' => kecepatan_putaran($request),
                    'data_sertifikat' => $sertifikatTachometer->data,
                ]);
                // WAKTU PUTAR
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'waktu_putaran',
                    'data_laporan' => waktu_putaran($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.EXAMINATION_LAMP')) {
                // Intensitas Cahaya
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'intensitas_cahaya',
                    'data_laporan' => intensitas_cahaya($request),
                    'data_sertifikat' => $luxMeter->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.OPERATING_LAMP')) {
                // Intensitas Cahaya
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'intensitas_cahaya_lengan_1',
                    'data_laporan' => intensitas_cahaya_lengan_1($request),
                    'data_sertifikat' => $luxMeter->data,
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'intensitas_cahaya_lengan_2',
                    'data_laporan' => intensitas_cahaya_lengan_2($request),
                    'data_sertifikat' => $luxMeter->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.HUMIDIFIER')) {
                // Intensitas Cahaya
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'suhu_udara',
                    'data_laporan' => suhu_udara($request),
                    'data_sertifikat' => '',
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'kelembapan_udara',
                    'data_laporan' => kelembapan_udara($request),
                    'data_sertifikat' => '',
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.NEOPUFF')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'peak_inspiratory_pressure',
                    'data_laporan' => peak_inspiratory_pressure($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.VEIN_FINDER')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'spectral_irradiance',
                    'data_laporan' => spectral_irradiance($request),
                    'data_sertifikat' => $solarPowerPanel->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.STIRER')) {
                // KINERJA PUTARAN
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'kinerja_putaran',
                    'data_laporan' => kinerja_putaran($request),
                    'data_sertifikat' => $sertifikatTachometer->data,
                ]);
                // KINERJA WAKTU
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'waktu_putaran',
                    'data_laporan' => waktu_putaran($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.PULSE_OXYMETER')) {
                // HEART RATE
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'heart_rate_pulse_oxymeter',
                    'data_laporan' => heart_rate_pulse_oxymeter($request),
                    'data_sertifikat' => $spo2_Simulator->data,
                ]);
                // SATURASI OKSIGEN
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'saturasi_oksigen_pulse_oxymeter',
                    'data_laporan' => saturasi_oksigen_pulse_oxymeter($request),
                    'data_sertifikat' => $spo2_Simulator->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.PHOTOTHERAPY')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'spectral_irradiance_phototherapy',
                    'data_laporan' => spectral_irradiance_phototherapy($request),
                    'data_sertifikat' => $phototherapyRadiometer->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.TIMER')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'akurasi_waktu',
                    'data_laporan' => akurasi_waktu($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.FLOWMETER')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'flowmeter',
                    'data_laporan' => flowmeter($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.CPAP')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'flowmeter',
                    'data_laporan' => flowmeter_cpap($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'konsentrasi_oksigen',
                    'data_laporan' => konsentrasi_oksigen($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.OKSIGEN_CONCENTRATOR')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'flowmeter_oksigen_concentrator',
                    'data_laporan' => flowmeter_oksigen_concentrator($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'konsentrasi_oksigen_concentrator',
                    'data_laporan' => konsentrasi_oksigen_concentrator($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.HFNC')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'flowmeter_hfnc',
                    'data_laporan' => flowmeter_hfnc($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'konsentrasi_oksigen_hfnc',
                    'data_laporan' => konsentrasi_oksigen_hfnc($request),
                    'data_sertifikat' => $ventilatorAnalyzer->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.TRAKSI')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'tekanan_traksi',
                    'data_laporan' => tekanan_traksi($request),
                    'data_sertifikat' => $ForceGauge->data,
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'timer_traksi',
                    'data_laporan' => timer_traksi($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.UV_STERILIZER')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'spectral_irradiance_uv',
                    'data_laporan' => spectral_irradiance_uv($request),
                    'data_sertifikat' => $sertifikatUvRadiometer->data,
                ]);

                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'waktu_tunda_va',
                    'data_laporan' => waktu_tunda_va($request),
                    'data_sertifikat' => $sertifikatDigitalStopWatch->data,
                ]);
            } else if ($request->nomenklatur_id == config('nomenklatur.MIKROSKOP')) {
                DB::table('laporan_kinerja')->insert([
                    'no_laporan' => $laporan->no_laporan,
                    'type_laporan_kinerja' => 'skala_pembesaran',
                    'data_laporan' => skala_pembesaran($request),
                    'data_sertifikat' => json_encode([])
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

            DB::commit();

            toast('Berhasil membuat data laporan', 'success');
            return redirect()->route('home');
        } catch (\Exception $e) {
            DB::rollback();
            toast('Gagal membuat data laporan', 'error');
            return redirect()->back()->withInput();
        }
    }

    private function preg_grep_keys($pattern, $input, $flags = 0)
    {
        return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
    }
}
