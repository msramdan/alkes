<?php

namespace App\Http\Controllers;

use App\Models\BannerManagement;
use App\Http\Requests\{StoreBannerManagementRequest, UpdateBannerManagementRequest};
use Yajra\DataTables\Facades\DataTables;

class BannerManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:banner management view')->only('index', 'show');
        $this->middleware('permission:banner management create')->only('create', 'store');
        $this->middleware('permission:banner management edit')->only('edit', 'update');
        $this->middleware('permission:banner management delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $bannerManagements = BannerManagement::query();

            return DataTables::of($bannerManagements)
                ->addColumn('action', 'banner-managements.include.action')
                ->toJson();
        }

        return view('banner-managements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner-managements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerManagementRequest $request)
    {
        
        BannerManagement::create($request->validated());

        return redirect()
            ->route('banner-managements.index')
            ->with('success', __('The bannerManagement was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerManagement  $bannerManagement
     * @return \Illuminate\Http\Response
     */
    public function show(BannerManagement $bannerManagement)
    {
        return view('banner-managements.show', compact('bannerManagement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerManagement  $bannerManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerManagement $bannerManagement)
    {
        return view('banner-managements.edit', compact('bannerManagement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerManagement  $bannerManagement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerManagementRequest $request, BannerManagement $bannerManagement)
    {
        
        $bannerManagement->update($request->validated());

        return redirect()
            ->route('banner-managements.index')
            ->with('success', __('The bannerManagement was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerManagement  $bannerManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerManagement $bannerManagement)
    {
        try {
            $bannerManagement->delete();

            return redirect()
                ->route('banner-managements.index')
                ->with('success', __('The bannerManagement was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('banner-managements.index')
                ->with('error', __("The bannerManagement can't be deleted because it's related to another table."));
        }
    }
}
