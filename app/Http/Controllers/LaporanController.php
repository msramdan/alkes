<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Http\Requests\{StoreLaporanRequest, UpdateLaporanRequest};
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:laporan view')->only('index', 'show');
        $this->middleware('permission:laporan edit')->only('edit', 'update');
        $this->middleware('permission:laporan delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $laporans = Laporan::with('user:id,name', 'user_review:id,name',);

            return DataTables::of($laporans)
                ->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
                })->addColumn('user_review', function ($row) {
                    return $row->user_review ? $row->user_review->name : '';
                })->addColumn('action', 'laporans.include.action')
                ->toJson();
        }

        return view('laporans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        $laporan->load('user:id,name', 'user:id,name',);

        return view('laporans.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        $laporan->load('user:id,name', 'user:id,name',);

        return view('laporans.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaporanRequest $request, Laporan $laporan)
    {

        $laporan->update($request->validated());

        return redirect()
            ->route('laporans.index')
            ->with('success', __('The laporan was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        try {
            $laporan->delete();

            return redirect()
                ->route('laporans.index')
                ->with('success', __('The laporan was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('laporans.index')
                ->with('error', __("The laporan can't be deleted because it's related to another table."));
        }
    }
}
