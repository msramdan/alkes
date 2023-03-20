<?php

namespace App\Http\Controllers;

use App\Models\MetodeKerja;
use App\Http\Requests\{StoreMetodeKerjaRequest, UpdateMetodeKerjaRequest};
use Yajra\DataTables\Facades\DataTables;

class MetodeKerjaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:metode kerja view')->only('index', 'show');
        $this->middleware('permission:metode kerja create')->only('create', 'store');
        $this->middleware('permission:metode kerja edit')->only('edit', 'update');
        $this->middleware('permission:metode kerja delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $metodeKerjas = MetodeKerja::query();

            return DataTables::of($metodeKerjas)
                ->addColumn('action', 'metode-kerjas.include.action')
                ->toJson();
        }

        return view('metode-kerjas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metode-kerjas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMetodeKerjaRequest $request)
    {
        
        MetodeKerja::create($request->validated());

        return redirect()
            ->route('metode-kerjas.index')
            ->with('success', __('The metodeKerja was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function show(MetodeKerja $metodeKerja)
    {
        return view('metode-kerjas.show', compact('metodeKerja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(MetodeKerja $metodeKerja)
    {
        return view('metode-kerjas.edit', compact('metodeKerja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMetodeKerjaRequest $request, MetodeKerja $metodeKerja)
    {
        
        $metodeKerja->update($request->validated());

        return redirect()
            ->route('metode-kerjas.index')
            ->with('success', __('The metodeKerja was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetodeKerja $metodeKerja)
    {
        try {
            $metodeKerja->delete();

            return redirect()
                ->route('metode-kerjas.index')
                ->with('success', __('The metodeKerja was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('metode-kerjas.index')
                ->with('error', __("The metodeKerja can't be deleted because it's related to another table."));
        }
    }
}
