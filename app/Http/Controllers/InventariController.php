<?php

namespace App\Http\Controllers;

use App\Exports\InventarisExport;
use App\Models\Inventari;
use App\Models\Room;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Vendor;
use App\Http\Requests\{StoreInventariRequest, UpdateInventariRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Response;

class InventariController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:inventari view')->only('index', 'show');
        $this->middleware('permission:inventari create')->only('create', 'store');
        $this->middleware('permission:inventari edit')->only('edit', 'update');
        $this->middleware('permission:inventari delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $inventaris
                = DB::table('inventaris')
                ->join('rooms', 'inventaris.ruangan_id', '=', 'rooms.id')
                ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
                ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
                ->join('vendors', 'inventaris.vendor_id', '=', 'vendors.id')
                ->select('inventaris.*', 'rooms.nama_ruangan', 'brands.nama_merek', 'types.jenis_alat', 'vendors.nama_vendor');
            $ruangan = intval($request->query('ruangan'));
            $merek = intval($request->query('merek'));
            $jenis_alat = intval($request->query('jenis_alat'));
            $vendor = intval($request->query('vendor'));


            if (isset($ruangan) && !empty($ruangan)) {
                if ($ruangan != 'All') {
                    $inventaris = $inventaris->where('ruangan_id', $ruangan);
                }
            }
            if (isset($merek) && !empty($merek)) {
                if ($merek != 'All') {
                    $inventaris = $inventaris->where('merk_id', $merek);
                }
            }
            if (isset($jenis_alat) && !empty($jenis_alat)) {
                if ($jenis_alat != 'All') {
                    $inventaris = $inventaris->where('jenis_alat_id', $jenis_alat);
                }
            }

            if (isset($vendor) && !empty($vendor)) {
                if ($vendor != 'All') {
                    $inventaris = $inventaris->where('vendor_id', $vendor);
                }
            }

            $inventaris = $inventaris->orderBy('inventaris.id', 'desc')->get();

            return DataTables::of($inventaris)
                ->addIndexColumn()
                ->addColumn('room', function ($row) {
                    return $row->nama_ruangan;
                })->addColumn('type', function ($row) {
                    return $row->jenis_alat;
                })->addColumn('brand', function ($row) {
                    return $row->nama_merek;
                })->addColumn('vendor', function ($row) {
                    return $row->nama_vendor;
                })->addColumn('action', 'inventaris.include.action')
                ->toJson();
        }

        $rooms = Room::orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $types = Type::orderBy('id', 'DESC')->get();
        $vendors = Vendor::orderBy('id', 'DESC')->get();
        return view('inventaris.index', [
            'rooms' => $rooms,
            'brands' => $brands,
            'types' => $types,
            'vendors' => $vendors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventariRequest $request)
    {

        Inventari::create($request->validated());

        return redirect()
            ->route('inventaris.index')
            ->with('success', __('The inventari was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventari  $inventari
     * @return \Illuminate\Http\Response
     */
    public function show(Inventari $inventari)
    {
        $inventari->load('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor',);

        return view('inventaris.show', compact('inventari'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventari  $inventari
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventari $inventari)
    {
        $inventari->load('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor',);
        $types = Type::select('id', 'jenis_alat')->where('id', $inventari->jenis_alat_id)->get();
        return view('inventaris.edit', compact('inventari', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventari  $inventari
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventariRequest $request, Inventari $inventari)
    {

        $inventari->update($request->validated());

        return redirect()
            ->route('inventaris.index')
            ->with('success', __('The inventari was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventari  $inventari
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventari $inventari)
    {
        try {
            $inventari->delete();
            return redirect()
                ->route('inventaris.index')
                ->with('success', __('The inventari was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('inventaris.index')
                ->with('error', __("The inventari can't be deleted because it's related to another table."));
        }
    }

    public function export($ruangan, $merek, $jenis_alat, $vendor)
    {
        $date = date('d-m-Y');
        $nameFile = 'Report_Inventory' . $date;
        return Excel::download(new InventarisExport($ruangan, $merek, $jenis_alat, $vendor), $nameFile . '.xlsx');
    }

    public function inventarisSertifikat($inventaris_id)
    {
        $data = Inventari::findOrFail($inventaris_id);

        $viewMapping = [
            config('type_inventaris.Thermohygrometer') => 'inventaris.sertifikat.Thermohygrometer',
            config('type_inventaris.DigitalStopWatch')  => 'inventaris.sertifikat.DigitalStopWatch',
            config('type_inventaris.Electrical_Safety_Analyzer')  => 'inventaris.sertifikat.ElectricalSafetyAnalyzer',
            config('type_inventaris.FETAL_SIMULATOR') => 'inventaris.sertifikat.FetalSimulator',
            config('type_inventaris.ContactTachometer')  => 'inventaris.sertifikat.ContactTachometer',
            config('type_inventaris.TemperatureRecorder')  => 'inventaris.sertifikat.TemperatureRecorder',
            config('type_inventaris.DigitalPressureMeter')  => 'inventaris.sertifikat.DigitalPressureMeter',
            config('type_inventaris.InfusionDeviceAnalyzer')  => 'inventaris.sertifikat.InfusionDeviceAnalyzer',
            config('type_inventaris.LUX_METER') => 'inventaris.sertifikat.LuxMeter',
            config('type_inventaris.Electrical_Surgery_Analyzer') => 'inventaris.sertifikat.ElectricalSurgeryAnalyzer',
            config('type_inventaris.Thermometer_Reference') => 'inventaris.sertifikat.Thermometer_Reference',
            config('type_inventaris.Ventilator_Analyzer') => 'inventaris.sertifikat.VentilatorAnalyzer',
            config('type_inventaris.Anaesthesi_Gas_Analyzer') => 'inventaris.sertifikat.AnaesthesiGasAnalyzer',
            config('type_inventaris.Waterbath') => 'inventaris.sertifikat.Waterbath',
            config('type_inventaris.Incubator_Analyzer') => 'inventaris.sertifikat.Incubator_Analyzer',
            config('type_inventaris.Solar_Power_Meter') => 'inventaris.sertifikat.Solar_Power_Meter',
            config('type_inventaris.SPO2_Simulator') => 'inventaris.sertifikat.SPO2_Simulator',
            config('type_inventaris.Phototherapy_Radiometer') => 'inventaris.sertifikat.Phototherapy_Radiometer',
        ];

        $view = $viewMapping[$data->jenis_alat_id] ?? null;

        if ($view) {
            return view($view, compact('data'));
        }

        abort(404, 'Jenis alat tidak ditemukan.');
    }

    public function sertifikatSave(Request $request)
    {
        $data = Inventari::findOrFail($request->inventaris_id);
        $file = $request->file('file');
        $file->storeAs('public/sertifikat', $file->hashName());

        // Konfigurasi jenis alat dan field
        $jenisAlatFields = [
            3 => ['intercept', 'x_variable', 'u', 'drift_300'], // Digital Stop Watch
            5 => ['intercept1', 'x_variable1', 'intercept2', 'x_variable2', 'intercept3', 'x_variable3'], // Electrical Safety Analyzer
            22 => [
                'intercept',
                'x_variable',
                'u60',
                'u100',
                'u500',
                'u1000',
                'u5000',
                '10000',
                'drift_1000',
                'drift_2000',
                'drift_3000',
                'drift_4000'
            ], // Contact Tachometer
            37 => array_merge(
                array_map(fn($i) => ["slope_$i", "intercept_$i", "uc_$i"], range(1, 10)) // Thermohygrometer
            ),
            39 => ['uc_suhu', 'intercept_suhu', 'x_variable_suhu', 'uc_kelembapan', 'intercept_kelembapan', 'x_variable_kelembapan'], // Thermohygrometer
            45 => [
                'intercept_naik',
                'x_variable_naik',
                'intercept_turun',
                'x_variable_turun',
                'uc',
                'drift0_naik',
                'drift0_turun',
                'drift50_naik',
                'drift50_turun',
                'drift100_naik',
                'drift100_turun',
                'drift150_naik',
                'drift150_turun',
                'drift200_naik',
                'drift200_turun',
                'drift250_naik',
                'drift250_turun',
                'drift300_naik',
                'drift300_turun',
                'drift350_naik',
                'drift350_turun'
            ], // Digital Pressure Meter
            46 => [
                'slope_1',
                'intercept_1',
                'uc_1',
                'slope_2',
                'intercept_2',
                'uc_2',
                'drift10_1',
                'drift50_1',
                'drift100_1',
                'drift500_1',
                'drift10_2',
                'drift50_2',
                'drift100_2',
                'drift500_2'
            ], // IDA
            config('type_inventaris.FETAL_SIMULATOR') => ['slope', 'intercept', 'uc'], // Fetal Simulator
            config('type_inventaris.LUX_METER') => ['slope', 'intercept'], // Lux Meter
            config('type_inventaris.Electrical_Surgery_Analyzer') => [
                'watt_intercept',
                'watt_slope',
                'arus_intercept',
                'arus_slope',
                'resistensi_intercept',
                'resistensi_slope'
            ], // Electrical Surgery Analyzer
            config('type_inventaris.Ventilator_Analyzer') => [
                'slope_flow_meter',
                'intercept_flow_meter',
                'slope_konsentrasi_oksigen',
                'intercept_konsentrasi_oksigen'
            ], // Ventilator Analyzer
            config('type_inventaris.Thermometer_Reference') => ['slope', 'intercept'], // Thermometer Reference
            config('type_inventaris.Anaesthesi_Gas_Analyzer') => ['intercept', 'x_variable_1'], // Anaesthesi Gas Analyzer
            config('type_inventaris.Waterbath') => ['intercept', 'x_variable_1'], // Waterbath
            config('type_inventaris.Solar_Power_Meter') => ['slope', 'intercept', 'u'], // Solar Power Meter
            config('type_inventaris.SPO2_Simulator') => ['slope_bpm', 'intercept_bpm', 'u_bpm', 'slope_o2', 'intercept_o2', 'u_o2'], // SPO2_Simulator
        ];

        $fields = $jenisAlatFields[$data->jenis_alat_id] ?? [];
        $insertData = [
            'inventaris_id' => $request->inventaris_id,
            'tahun' => $request->tahun,
        ];

        foreach ($fields as $field) {
            $insertData[$field] = $request->get($field);
        }

        DB::table('sertifikat_inventaris')->insert([
            'inventaris_id' => $request->inventaris_id,
            'tahun' => $request->tahun,
            'data' => json_encode($insertData),
            'file' => $file->hashName(),
        ]);

        return redirect()->back()->with('success', __('Data berhasil disimpan.'));
    }

    public function SertifikatDelete($id)
    {
        $sertifikat = DB::table('sertifikat_inventaris')
            ->join('inventaris', 'sertifikat_inventaris.inventaris_id', '=', 'inventaris.id')
            ->where('sertifikat_inventaris.id', $id)
            ->select('sertifikat_inventaris.*', 'inventaris.jenis_alat_id')
            ->first();
        if ($sertifikat) {
            Storage::delete('public/sertifikat/' . $sertifikat->file);
            DB::table('sertifikat_inventaris')->where('id', $id)->delete();
            return redirect()
                ->back()
                ->with('success', __('Sertifikat inventaris berhasil dihapus'));
        } else {
            return redirect()
                ->back()
                ->with('error', __('Sertikat tidak ditemukan'));
        }
    }

    public function getDownload($inventaris_id, $id)
    {
        $getInventaris = Inventari::find($inventaris_id);
        $data = DB::table('sertifikat_inventaris')->where('id', $id)->first();
        $file = public_path() . "/storage/sertifikat/" . $data->file;
        $tahun = $data->tahun;
        $nama = 'Sertifikat ' . $getInventaris->serial_number . '-' . $tahun . '.xlsx';
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel',
        );
        return Response::download($file, $nama, $headers);
    }
}
