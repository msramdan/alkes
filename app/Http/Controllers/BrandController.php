<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\{StoreBrandRequest, UpdateBrandRequest};
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:brand view')->only('index', 'show');
        $this->middleware('permission:brand create')->only('create', 'store');
        $this->middleware('permission:brand edit')->only('edit', 'update');
        $this->middleware('permission:brand delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $brands = Brand::query();

            return DataTables::of($brands)
                ->addColumn('action', 'brands.include.action')
                ->toJson();
        }

        return view('brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        
        Brand::create($request->validated());

        return redirect()
            ->route('brands.index')
            ->with('success', __('The brand was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        
        $brand->update($request->validated());

        return redirect()
            ->route('brands.index')
            ->with('success', __('The brand was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();

            return redirect()
                ->route('brands.index')
                ->with('success', __('The brand was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('brands.index')
                ->with('error', __("The brand can't be deleted because it's related to another table."));
        }
    }
}
