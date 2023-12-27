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
        /*
        3 = Digital Stop Watch
        5 = Electrical Safety Analyzer
        37 = Thermocouple type K / Temperature Recorder
        39 = Thermohygrometer
        45 = DPM
        46 = Infusion Device Analyzer
        ==========================================================================*/
        $data = Inventari::where('id', $inventaris_id)->first();
        if ($data->jenis_alat_id == 39) {
            return view('inventaris.sertifikat.Thermohygrometer', compact('data'));
        } else if ($data->jenis_alat_id == 3) {
            return view('inventaris.sertifikat.DigitalStopWatch', compact('data'));
        } else if ($data->jenis_alat_id == 5) {
            return view('inventaris.sertifikat.ElectricalSafetyAnalyzer', compact('data'));
        } else if ($data->jenis_alat_id == config('type_inventaris.FETAL_SIMULATOR')) {
            return view('inventaris.sertifikat.FetalSimulator', compact('data'));
        } else if ($data->jenis_alat_id == 22) {
            return view('inventaris.sertifikat.ContactTachometer', compact('data'));
        } else if ($data->jenis_alat_id == 37) {
            return view('inventaris.sertifikat.TemperatureRecorder', compact('data'));
        } else if ($data->jenis_alat_id == 45) {
            return view('inventaris.sertifikat.DigitalPressureMeter', compact('data'));
        } else if ($data->jenis_alat_id == 46) {
            return view('inventaris.sertifikat.InfusionDeviceAnalyzer', compact('data'));
        } else if ($data->jenis_alat_id == config('type_inventaris.LUX_METER')) {
            return view('inventaris.sertifikat.LuxMeter', compact('data'));
        }
    }

    public function sertifikatSave(Request $request)
    {
        $data = Inventari::where('id', $request->inventaris_id)->first();
        $file = $request->file('file');
        $file->storeAs('public/sertifikat', $file->hashName());
        if ($data->jenis_alat_id == 3) {
            // Digital Stop Watch
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'intercept' => $request->intercept,
                'x_variable' => $request->x_variable,
                'u' => $request->u,
                'drift_300' => $request->drift_300,
            ];
        } else if ($data->jenis_alat_id == 5) {
            // Electrical Safety Analyzer
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'intercept1' => $request->intercept1,
                'x_variable1' => $request->x_variable1,
                'intercept2' => $request->intercept2,
                'x_variable2' => $request->x_variable2,
                'intercept3' => $request->intercept3,
                'x_variable3' => $request->x_variable3,
            ];
        } else if ($data->jenis_alat_id == 22) {
            // Contact Tachometer
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'intercept' => $request->intercept,
                'x_variable' => $request->x_variable,
                'u60' => $request->u60,
                'u100' => $request->u100,
                'u500' => $request->u500,
                'u1000' => $request->u1000,
                'u5000' => $request->u5000,
                '10000' => $request->u10000,
                'drift_1000' => $request->drift_1000,
                'drift_2000' => $request->drift_2000,
                'drift_3000' => $request->drift_3000,
                'drift_4000' => $request->drift_4000,

            ];
        } else if ($data->jenis_alat_id == 37) {
            // Thermohygrometer
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'slope_1' => $request->slope_1,
                'intercept_1' => $request->intercept_1,
                'uc_1' => $request->uc_1,
                'slope_2' => $request->slope_2,
                'intercept_2' => $request->intercept_2,
                'uc_2' => $request->uc_2,
                'slope_3' => $request->slope_3,
                'intercept_3' => $request->intercept_3,
                'uc_3' => $request->uc_3,
                'slope_4' => $request->slope_4,
                'intercept_4' => $request->intercept_4,
                'uc_4' => $request->uc_4,
                'slope_5' => $request->slope_5,
                'intercept_5' => $request->intercept_5,
                'uc_5' => $request->uc_5,

                'slope_6' => $request->slope_6,
                'intercept_6' => $request->intercept_6,
                'uc_6' => $request->uc_6,
                'slope_7' => $request->slope_7,
                'intercept_7' => $request->intercept_7,
                'uc_7' => $request->uc_7,
                'slope_8' => $request->slope_8,
                'intercept_8' => $request->intercept_8,
                'uc_8' => $request->uc_8,
                'slope_9' => $request->slope_9,
                'intercept_9' => $request->intercept_9,
                'uc_9' => $request->uc_9,
                'slope_10' => $request->slope_10,
                'intercept_10' => $request->intercept_10,
                'uc_10' => $request->uc_10,
            ];
        } else if ($data->jenis_alat_id == 39) {
            // Thermohygrometer
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'uc_suhu' => $request->uc_suhu,
                'intercept_suhu' => $request->intercept_suhu,
                'x_variable_suhu' => $request->x_variable_suhu,
                'uc_kelembapan' => $request->uc_kelembapan,
                'intercept_kelembapan' => $request->intercept_kelembapan,
                'x_variable_kelembapan' => $request->x_variable_kelembapan,
            ];
        } else if ($data->jenis_alat_id == 45) {
            // Digital Pressure Meter
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'intercept_naik' => $request->intercept_naik,
                'x_variable_naik' => $request->x_variable_naik,
                'intercept_turun' => $request->intercept_turun,
                'x_variable_turun' => $request->x_variable_turun,
                'uc' => $request->uc,
                'drift0_naik' => $request->drift0_naik,
                'drift0_turun' => $request->drift0_turun,
                'drift50_naik' => $request->drift50_naik,
                'drift50_turun' => $request->drift50_turun,
                'drift100_naik' => $request->drift100_naik,
                'drift100_turun' => $request->drift100_turun,
                'drift150_naik' => $request->drift150_naik,
                'drift150_turun' => $request->drift150_turun,
                'drift200_naik' => $request->drift200_naik,
                'drift200_turun' => $request->drift200_turun,
                'drift250_naik' => $request->drift250_naik,
                'drift250_turun' => $request->drift250_turun,
                'drift300_naik' => $request->drift300_naik,
                'drift300_turun' => $request->drift300_turun,
                'drift350_naik' => $request->drift350_naik,
                'drift350_turun' => $request->drift350_turun,
            ];
        } else if ($data->jenis_alat_id == 46) {
            // IDA
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'slope_1' => $request->slope_1,
                'intercept_1' => $request->intercept_1,
                'uc_1' => $request->uc_1,
                'slope_2' => $request->slope_2,
                'intercept_2' => $request->intercept_2,
                'uc_2' => $request->uc_2,
                'drift10_1' => $request->drift10_1,
                'drift50_1' => $request->drift50_1,
                'drift100_1' => $request->drift100_1,
                'drift500_1' => $request->drift500_1,
                'drift10_2' => $request->drift10_2,
                'drift50_2' => $request->drift50_2,
                'drift100_2' => $request->drift100_2,
                'drift500_2' => $request->drift500_2,
            ];
        } else if ($data->jenis_alat_id == config('type_inventaris.FETAL_SIMULATOR')) {
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'slope' => $request->slope,
                'intercept' => $request->intercept,
                'uc' => $request->uc,
            ];
        } else if ($data->jenis_alat_id == config('type_inventaris.LUX_METER')) {
            $data = [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'slope' => $request->slope,
                'intercept' => $request->intercept,
            ];
        }

        DB::table('sertifikat_inventaris')->insert(
            [
                'inventaris_id' => $request->inventaris_id,
                'tahun' => $request->tahun,
                'data' => json_encode($data),
                'file' =>  $file->hashName(),
            ],
        );
        return redirect()
            ->back()
            ->with('success', __('Sertifikat inventaris berhasil disimpan'));
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
