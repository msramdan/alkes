<?php

namespace App\Http\Controllers;

use App\Models\Faske;
use App\Http\Requests\{StoreFaskeRequest, UpdateFaskeRequest};
use Yajra\DataTables\Facades\DataTables;

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
    public function index()
    {
        if (request()->ajax()) {
            $faskes = Faske::with('jenis_faske:id,nama_jenis_faskes', 'province:id,provinsi', 'kabkot:id,provinsi_id', 'kecamatan:id,kabkot_id', 'kelurahan:id,kecamatan_id');

            return DataTables::of($faskes)
                ->addColumn('alamat', function($row){
                    return str($row->alamat)->limit(100);
                })
				->addColumn('jenis_faske', function ($row) {
                    return $row->jenis_faske ? $row->jenis_faske->nama_jenis_faskes : '';
                })->addColumn('province', function ($row) {
                    return $row->province ? $row->province->provinsi : '';
                })->addColumn('kabkot', function ($row) {
                    return $row->kabkot ? $row->kabkot->provinsi_id : '';
                })->addColumn('kecamatan', function ($row) {
                    return $row->kecamatan ? $row->kecamatan->kabkot_id : '';
                })->addColumn('kelurahan', function ($row) {
                    return $row->kelurahan ? $row->kelurahan->kecamatan_id : '';
                })->addColumn('action', 'faskes.include.action')
                ->toJson();
        }

        return view('faskes.index');
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

		return view('faskes.edit', compact('faske'));
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
}
