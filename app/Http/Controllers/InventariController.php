<?php

namespace App\Http\Controllers;

use App\Models\Inventari;
use App\Http\Requests\{StoreInventariRequest, UpdateInventariRequest};
use Yajra\DataTables\Facades\DataTables;

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
    public function index()
    {
        if (request()->ajax()) {
            $inventaris = Inventari::with('room:id,nama_ruangan', 'type:id,jenis_alat', 'brand:id,nama_merek', 'vendor:id,nama_vendor');

            return DataTables::of($inventaris)
                ->addIndexColumn()
                ->addColumn('room', function ($row) {
                    return $row->room ? $row->room->nama_ruangan : '';
                })->addColumn('type', function ($row) {
                    return $row->type ? $row->type->jenis_alat : '';
                })->addColumn('brand', function ($row) {
                    return $row->brand ? $row->brand->nama_merek : '';
                })->addColumn('vendor', function ($row) {
                    return $row->vendor ? $row->vendor->nama_vendor : '';
                })->addColumn('action', 'inventaris.include.action')
                ->toJson();
        }

        return view('inventaris.index');
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

        return view('inventaris.edit', compact('inventari'));
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
}
