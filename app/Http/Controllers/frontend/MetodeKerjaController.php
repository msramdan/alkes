<?php

namespace App\Http\Controllers\frontend;

use App\Models\MetodeKerja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MetodeKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home', [
            'banner' => BannerManagement::orderBy('posisi', 'ASC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function show(MetodeKerja $metodeKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(MetodeKerja $metodeKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetodeKerja $metodeKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MetodeKerja  $metodeKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetodeKerja $metodeKerja)
    {
        //
    }
}
