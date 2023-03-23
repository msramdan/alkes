<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Http\Requests\{StoreProvinceRequest, UpdateProvinceRequest};
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:province view')->only('index', 'show');
        $this->middleware('permission:province create')->only('create', 'store');
        $this->middleware('permission:province edit')->only('edit', 'update');
        $this->middleware('permission:province delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $provinces = Province::query();

            return DataTables::of($provinces)
                ->addIndexColumn()
                ->addColumn('action', 'provinces.include.action')
                ->toJson();
        }

        return view('provinces.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvinceRequest $request)
    {

        Province::create($request->validated());

        return redirect()
            ->route('provinces.index')
            ->with('success', __('The province was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        return view('provinces.show', compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        return view('provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {

        $province->update($request->validated());

        return redirect()
            ->route('provinces.index')
            ->with('success', __('The province was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        try {
            $province->delete();

            return redirect()
                ->route('provinces.index')
                ->with('success', __('The province was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('provinces.index')
                ->with('error', __("The province can't be deleted because it's related to another table."));
        }
    }
}
