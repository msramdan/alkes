<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\{StoreVendorRequest, UpdateVendorRequest};
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:vendor view')->only('index', 'show');
        $this->middleware('permission:vendor create')->only('create', 'store');
        $this->middleware('permission:vendor edit')->only('edit', 'update');
        $this->middleware('permission:vendor delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $vendors = Vendor::orderBy('id', 'DESC')->get();


            return DataTables::of($vendors)
                ->addIndexColumn()
                ->addColumn('action', 'vendors.include.action')
                ->toJson();
        }

        return view('vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {

        Vendor::create($request->validated());

        return redirect()
            ->route('vendors.index')
            ->with('success', __('The vendor was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {

        $vendor->update($request->validated());

        return redirect()
            ->route('vendors.index')
            ->with('success', __('The vendor was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        try {
            $vendor->delete();

            return redirect()
                ->route('vendors.index')
                ->with('success', __('The vendor was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('vendors.index')
                ->with('error', __("The vendor can't be deleted because it's related to another table."));
        }
    }
}
