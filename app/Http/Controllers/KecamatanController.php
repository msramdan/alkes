<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Http\Requests\{StoreKecamatanRequest, UpdateKecamatanRequest};
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kecamatan view')->only('index', 'show');
        $this->middleware('permission:kecamatan create')->only('create', 'store');
        $this->middleware('permission:kecamatan edit')->only('edit', 'update');
        $this->middleware('permission:kecamatan delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $kecamatans = Kecamatan::with('kabkot:id,kabupaten_kota');

            return DataTables::of($kecamatans)
                ->addIndexColumn()
                ->addColumn('kabkot', function ($row) {
                    return $row->kabkot ? $row->kabkot->kabupaten_kota : '';
                })->addColumn('action', 'kecamatans.include.action')
                ->toJson();
        }

        return view('kecamatans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kecamatans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKecamatanRequest $request)
    {

        Kecamatan::create($request->validated());

        return redirect()
            ->route('kecamatans.index')
            ->with('success', __('The kecamatan was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        $kecamatan->load('kabkot:id,provinsi_id');

        return view('kecamatans.show', compact('kecamatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        $kecamatan->load('kabkot:id,provinsi_id');

        return view('kecamatans.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKecamatanRequest $request, Kecamatan $kecamatan)
    {

        $kecamatan->update($request->validated());

        return redirect()
            ->route('kecamatans.index')
            ->with('success', __('The kecamatan was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        try {
            $kecamatan->delete();

            return redirect()
                ->route('kecamatans.index')
                ->with('success', __('The kecamatan was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('kecamatans.index')
                ->with('error', __("The kecamatan can't be deleted because it's related to another table."));
        }
    }
}
