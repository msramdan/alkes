<?php

namespace App\Http\Controllers;

use App\Models\BannerManagement;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
                ->addIndexColumn()
                ->addColumn('banner_image', function ($row) {
                    $banner_image_path = Storage::url('public/img/banner_image/');
                    return asset($banner_image_path . $row->banner_image);
                })

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
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'banner_image' => 'required|image|mimes:png,jpg,jpeg',
                'posisi' => 'required|numeric',
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            //upload image
            $banner_image = $request->file('banner_image');
            $banner_image->storeAs('public/img/banner_image', $banner_image->hashName());

            BannerManagement::create([
                'posisi' => $request->posisi,
                'banner_image'     => $banner_image->hashName(),
            ]);
            return redirect()
                ->route('banner-managements.index')
                ->with('success', __('The bannerManagement was created successfully.'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('banner-managements.index')
                ->with('error', __('Data failed to save'));
        } finally {
            DB::commit();
        }
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
    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'banner_image' => 'image|mimes:png,jpg,jpeg',
                'posisi' => 'required|numeric',
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $banner = BannerManagement::findOrFail($id);
        if ($request->file('banner_image') != null || $request->file('banner_image') != '') {
            Storage::disk('local')->delete('public/img/banner_image/' . $banner->banner_image);
            $banner_image = $request->file('banner_image');
            $banner_image->storeAs('public/img/banner_image', $banner_image->hashName());
            $banner->update([
                'banner_image'     => $banner_image->hashName(),
            ]);
        }

        $banner->update([
            'posisi' => $request->posisi,
        ]);
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
            Storage::disk('local')->delete('public/img/banner_image/' . $bannerManagement->banner_image);
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
