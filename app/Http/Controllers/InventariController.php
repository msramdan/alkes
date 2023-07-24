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
        39 = Thermohygrometer
        ==========================================================================*/
        $data = Inventari::where('id', $inventaris_id)->first();
        if ($data->jenis_alat_id == 39) {
            return view('inventaris.sertifikat.Thermohygrometer', compact('data'));
        } else if ($data->jenis_alat_id == 5) {
            return view('inventaris.sertifikat.ElectricalSafetyAnalyzer', compact('data'));
        }
    }

    public function inventarisSertifikatSave(Request $request)
    {
        $data = Inventari::where('id', $request->inventaris_id)->first();
        if ($data->jenis_alat_id == 39) {
            //upload file
            $file = $request->file('file');
            $file->storeAs('public/sertifikat/Thermohygrometer', $file->hashName());
            DB::table('sertifikat_thermohygrometer')->insert(
                [
                    'inventaris_id' => $request->inventaris_id,
                    'tahun' => $request->tahun,
                    'uc_suhu' => $request->uc_suhu,
                    'intercept_suhu' => $request->intercept_suhu,
                    'x_variable_suhu' => $request->x_variable_suhu,
                    'uc_kelembapan' => $request->uc_kelembapan,
                    'intercept_kelembapan' => $request->intercept_kelembapan,
                    'x_variable_kelembapan' => $request->x_variable_kelembapan,
                    'file' =>  $file->hashName(),
                ]
            );
        } else if ($data->jenis_alat_id == 5) {
            //upload file
            $file = $request->file('file');
            $file->storeAs('public/sertifikat/sertifikat_electrical_safety_analyzer', $file->hashName());
            DB::table('sertifikat_electrical_safety_analyzer')->insert(
                [
                    'inventaris_id' => $request->inventaris_id,
                    'tahun' => $request->tahun,
                    'intercept1' => $request->intercept1,
                    'x_variable1' => $request->x_variable1,
                    'intercept2' => $request->intercept2,
                    'x_variable2' => $request->x_variable2,
                    'intercept3' => $request->intercept3,
                    'x_variable3' => $request->x_variable3,
                    'file' =>  $file->hashName(),
                ]
            );
        } else {
            die();
        }
        return redirect()
            ->back()
            ->with('success', __('Sertifikat inventaris berhasil disimpan'));
    }

    public function ThermohygrometerDelete($id)
    {
        $data = DB::table('sertifikat_thermohygrometer')->where('id', $id)->first();
        Storage::delete('public/sertifikat/Thermohygrometer/' . $data->file);
        DB::table('sertifikat_thermohygrometer')->where('id', $id)->delete();
        return redirect()
            ->back()
            ->with('success', __('Sertifikat inventaris berhasil dihapus'));
    }

    public function EsaDelete($id)
    {
        $data = DB::table('sertifikat_electrical_safety_analyzer')->where('id', $id)->first();
        Storage::delete('public/sertifikat/sertifikat_electrical_safety_analyzer/' . $data->file);
        DB::table('sertifikat_electrical_safety_analyzer')->where('id', $id)->delete();
        return redirect()
            ->back()
            ->with('success', __('Sertifikat inventaris berhasil dihapus'));
    }
    public function getDownload($inventaris_id, $id)
    {
        $getInventaris = Inventari::find($inventaris_id);
        if ($getInventaris->jenis_alat_id == 39) {
            $data = DB::table('sertifikat_thermohygrometer')->where('id', $id)->first();
            $file = public_path() . "/storage/sertifikat/Thermohygrometer/" . $data->file;
            $tahun = $data->tahun;
            $nama = 'Sertifikat Thermohygrometer ' . $getInventaris->serial_number . '-' . $tahun . '.xlsx';
        } else if ($getInventaris->jenis_alat_id == 5) {
            $data = DB::table('sertifikat_electrical_safety_analyzer')->where('id', $id)->first();
            $file = public_path() . "/storage/sertifikat/sertifikat_electrical_safety_analyzer/" . $data->file;
            $tahun = $data->tahun;
            $nama = 'Sertifikat ESA ' . $getInventaris->serial_number . '-' . $tahun . '.xlsx';
        }
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel',
        );
        return Response::download($file, $nama, $headers);
    }
}
