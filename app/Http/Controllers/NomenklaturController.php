<?php

namespace App\Http\Controllers;

use App\Models\Nomenklatur;
use App\Http\Requests\{StoreNomenklaturRequest, UpdateNomenklaturRequest};
use Yajra\DataTables\Facades\DataTables;

class NomenklaturController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:nomenklatur view')->only('index', 'show');
        $this->middleware('permission:nomenklatur create')->only('create', 'store');
        $this->middleware('permission:nomenklatur edit')->only('edit', 'update');
        $this->middleware('permission:nomenklatur delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $nomenklaturs = Nomenklatur::orderBy('id', 'DESC')->get();

            return DataTables::of($nomenklaturs)
                ->addIndexColumn()
                ->addColumn('action', 'nomenklaturs.include.action')
                ->toJson();
        }

        return view('nomenklaturs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomenklaturs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNomenklaturRequest $request)
    {

        Nomenklatur::create($request->validated());

        return redirect()
            ->route('nomenklaturs.index')
            ->with('success', __('The nomenklatur was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nomenklatur  $nomenklatur
     * @return \Illuminate\Http\Response
     */
    public function show(Nomenklatur $nomenklatur)
    {
        return view('nomenklaturs.show', compact('nomenklatur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nomenklatur  $nomenklatur
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomenklatur $nomenklatur)
    {
        return view('nomenklaturs.edit', compact('nomenklatur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nomenklatur  $nomenklatur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNomenklaturRequest $request, Nomenklatur $nomenklatur)
    {

        $nomenklatur->update($request->validated());

        return redirect()
            ->route('nomenklaturs.index')
            ->with('success', __('The nomenklatur was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nomenklatur  $nomenklatur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomenklatur $nomenklatur)
    {
        try {
            $nomenklatur->delete();

            return redirect()
                ->route('nomenklaturs.index')
                ->with('success', __('The nomenklatur was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('nomenklaturs.index')
                ->with('error', __("The nomenklatur can't be deleted because it's related to another table."));
        }
    }
}
