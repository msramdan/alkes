<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Http\Requests\{StoreKelurahanRequest, UpdateKelurahanRequest};
use Yajra\DataTables\Facades\DataTables;

class KelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kelurahan view')->only('index', 'show');
        $this->middleware('permission:kelurahan create')->only('create', 'store');
        $this->middleware('permission:kelurahan edit')->only('edit', 'update');
        $this->middleware('permission:kelurahan delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $kelurahans = Kelurahan::with('kecamatan:id,kecamatan');

            return DataTables::of($kelurahans)
                ->addIndexColumn()
                ->addColumn('kecamatan', function ($row) {
                    return $row->kecamatan ? $row->kecamatan->kecamatan : '';
                })->addColumn('action', 'kelurahans.include.action')
                ->toJson();
        }

        return view('kelurahans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelurahans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKelurahanRequest $request)
    {

        Kelurahan::create($request->validated());

        return redirect()
            ->route('kelurahans.index')
            ->with('success', __('The kelurahan was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        $kelurahan->load('kecamatan:id,kabkot_id');

        return view('kelurahans.show', compact('kelurahan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelurahan $kelurahan)
    {
        $kelurahan->load('kecamatan:id,kabkot_id');

        return view('kelurahans.edit', compact('kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKelurahanRequest $request, Kelurahan $kelurahan)
    {

        $kelurahan->update($request->validated());

        return redirect()
            ->route('kelurahans.index')
            ->with('success', __('The kelurahan was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelurahan $kelurahan)
    {
        try {
            $kelurahan->delete();

            return redirect()
                ->route('kelurahans.index')
                ->with('success', __('The kelurahan was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('kelurahans.index')
                ->with('error', __("The kelurahan can't be deleted because it's related to another table."));
        }
    }
}
