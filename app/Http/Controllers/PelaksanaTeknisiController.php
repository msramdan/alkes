<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaTeknisi;
use App\Http\Requests\{StorePelaksanaTeknisiRequest, UpdatePelaksanaTeknisiRequest};
use Yajra\DataTables\Facades\DataTables;

class PelaksanaTeknisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pelaksana teknis view')->only('index', 'show');
        $this->middleware('permission:pelaksana teknis create')->only('create', 'store');
        $this->middleware('permission:pelaksana teknis edit')->only('edit', 'update');
        $this->middleware('permission:pelaksana teknis delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $pelaksanaTeknisis = PelaksanaTeknisi::query();

            return DataTables::of($pelaksanaTeknisis)
                ->addColumn('action', 'pelaksana-teknisis.include.action')
                ->toJson();
        }

        return view('pelaksana-teknisis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelaksana-teknisis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelaksanaTeknisiRequest $request)
    {

        PelaksanaTeknisi::create($request->validated());

        return redirect()
            ->route('pelaksana-teknis.index')
            ->with('success', __('The pelaksanaTeknisi was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function show(PelaksanaTeknisi $pelaksanaTeknisi)
    {
        return view('pelaksana-teknisis.show', compact('pelaksanaTeknisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function edit(PelaksanaTeknisi $pelaksanaTeknisi)
    {
        return view('pelaksana-teknisis.edit', compact('pelaksanaTeknisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelaksanaTeknisiRequest $request, PelaksanaTeknisi $pelaksanaTeknisi)
    {

        $pelaksanaTeknisi->update($request->validated());

        return redirect()
            ->route('pelaksana-teknis.index')
            ->with('success', __('The pelaksanaTeknisi was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelaksanaTeknisi $pelaksanaTeknisi)
    {
        try {
            $pelaksanaTeknisi->delete();

            return redirect()
                ->route('pelaksana-teknis.index')
                ->with('success', __('The pelaksanaTeknisi was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('pelaksana-teknis.index')
                ->with('error', __("The pelaksanaTeknisi can't be deleted because it's related to another table."));
        }
    }
}
