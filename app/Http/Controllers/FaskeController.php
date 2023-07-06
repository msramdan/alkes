<?php

namespace App\Http\Controllers;

use App\Exports\FaskesExport;
use App\Models\Faske;
use App\Models\JenisFaske;
use App\Http\Requests\{StoreFaskeRequest, UpdateFaskeRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kabkot;
use Illuminate\Http\Request;

class FaskeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:faske view')->only('index', 'show');
        $this->middleware('permission:faske create')->only('create', 'store');
        $this->middleware('permission:faske edit')->only('edit', 'update');
        $this->middleware('permission:faske delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $faskes
                = DB::table('faskes')
                ->join('jenis_faskes', 'faskes.jenis_faskes_id', '=', 'jenis_faskes.id')
                ->join('provinces', 'faskes.provinsi_id', '=', 'provinces.id')
                ->join('kabkots', 'faskes.kabkot_id', '=', 'kabkots.id')
                ->join('kecamatans', 'faskes.kecamatan_id', '=', 'kecamatans.id')
                ->join('kelurahans', 'faskes.kelurahan_id', '=', 'kelurahans.id')
                ->select('faskes.*', 'jenis_faskes.nama_jenis_faskes', 'provinces.provinsi', 'kabkots.kabupaten_kota', 'kecamatans.kecamatan', 'kelurahans.kelurahan');
            $jenisFaskes = intval($request->query('jenisFaskes'));
            $kabkots = intval($request->query('kabkots'));
            if (isset($jenisFaskes) && !empty($jenisFaskes)) {
                if ($jenisFaskes != 'All') {
                    $faskes = $faskes->where('faskes.jenis_faskes_id', $jenisFaskes);
                }
            }
            if (isset($kabkots) && !empty($kabkots)) {
                if ($kabkots != 'All') {
                    $faskes = $faskes->where('faskes.kabkot_id', $kabkots);
                }
            }
            $faskes = $faskes->orderBy('faskes.id', 'desc')->get();

            return DataTables::of($faskes)
                ->addIndexColumn()
                ->addColumn('alamat', function ($row) {
                    return str($row->alamat)->limit(100);
                })
                ->addColumn('jenis_faske', function ($row) {
                    return $row->nama_jenis_faskes;
                })->addColumn('province', function ($row) {
                    return $row->provinsi;
                })->addColumn('kabkot', function ($row) {
                    return $row->kabupaten_kota;
                })->addColumn('kecamatan', function ($row) {
                    return $row->kecamatan;
                })->addColumn('kelurahan', function ($row) {
                    return $row->kelurahan;
                })->addColumn('action', 'faskes.include.action')
                ->toJson();
        }
        $jenisFaskes = JenisFaske::orderBy('id', 'DESC')->get();
        $kabkots = Kabkot::orderBy('id', 'DESC')->get();
        return view('faskes.index', [
            'jenisFaskes' => $jenisFaskes,
            'kabkots' => $kabkots,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faskes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaskeRequest $request)
    {

        Faske::create($request->validated());

        return redirect()
            ->route('faskes.index')
            ->with('success', __('The faske was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faske  $faske
     * @return \Illuminate\Http\Response
     */
    public function show(Faske $faske)
    {
        $faske->load('jenis_faske:id,nama_jenis_faskes', 'province:id,provinsi', 'kabkot:id,provinsi_id', 'kecamatan:id,kabkot_id', 'kelurahan:id,kecamatan_id');

        return view('faskes.show', compact('faske'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faske  $faske
     * @return \Illuminate\Http\Response
     */
    public function edit(Faske $faske)
    {
        $faske->load('jenis_faske:id,nama_jenis_faskes', 'province:id,provinsi', 'kabkot:id,provinsi_id', 'kecamatan:id,kabkot_id', 'kelurahan:id,kecamatan_id');
        $kabkot = DB::table('kabkots')->where('provinsi_id', $faske->provinsi_id)->get();
        $kecamatan = DB::table('kecamatans')->where('kabkot_id', $faske->kabkot_id)->get();
        $kelurahan = DB::table('kelurahans')->where('kecamatan_id', $faske->kecamatan_id)->get();

        return view('faskes.edit', compact('faske', 'kabkot', 'kecamatan', 'kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faske  $faske
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaskeRequest $request, Faske $faske)
    {

        $faske->update($request->validated());

        return redirect()
            ->route('faskes.index')
            ->with('success', __('The faske was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faske  $faske
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faske $faske)
    {
        try {
            $faske->delete();

            return redirect()
                ->route('faskes.index')
                ->with('success', __('The faske was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('faskes.index')
                ->with('error', __("The faske can't be deleted because it's related to another table."));
        }
    }

    public function export($jenisFaskes,  $kabkots)
    {
        $date = date('d-m-Y');
        $nameFile = 'Report_faskes' . $date;
        return Excel::download(new FaskesExport($jenisFaskes, $kabkots), $nameFile . '.xlsx');
    }

    public function updatePin(Request $request)
    {
        $faskes = Faske::findOrFail($request->id);
        $faskes->update([
            'pin' => $request->pin,
        ]);
        return redirect()
            ->route('faskes.index')
            ->with('success', __('Update pin updated successfully.'));
    }
}
