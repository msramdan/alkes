<?php

namespace App\Http\Controllers;

use App\Models\KontakMasukan;
use App\Http\Requests\{StoreKontakMasukanRequest, UpdateKontakMasukanRequest};
use Yajra\DataTables\Facades\DataTables;

class KontakMasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kontak masukan view')->only('index', 'show');
        $this->middleware('permission:kontak masukan delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $kontakMasukans = KontakMasukan::with('pelaksana_teknis:id,nama');

            return DataTables::of($kontakMasukans)
                ->addIndexColumn()
                ->addColumn('deksiprsi', function ($row) {
                    return str($row->deksiprsi)->limit(100);
                })
                ->addColumn('pelaksana_teknis', function ($row) {
                    return $row->pelaksana_teknis ? $row->pelaksana_teknis->nama : '';
                })->addColumn('action', 'kontak-masukans.include.action')
                ->toJson();
        }

        return view('kontak-masukans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kontak-masukans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKontakMasukanRequest $request)
    {

        KontakMasukan::create($request->validated());

        return redirect()
            ->route('kontak-masukans.index')
            ->with('success', __('The kontakMasukan was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KontakMasukan  $kontakMasukan
     * @return \Illuminate\Http\Response
     */
    public function show(KontakMasukan $kontakMasukan)
    {
        $kontakMasukan->load('pelaksana_tekni:id');

        return view('kontak-masukans.show', compact('kontakMasukan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KontakMasukan  $kontakMasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(KontakMasukan $kontakMasukan)
    {
        $kontakMasukan->load('pelaksana_tekni:id');

        return view('kontak-masukans.edit', compact('kontakMasukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KontakMasukan  $kontakMasukan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKontakMasukanRequest $request, KontakMasukan $kontakMasukan)
    {

        $kontakMasukan->update($request->validated());

        return redirect()
            ->route('kontak-masukans.index')
            ->with('success', __('The kontakMasukan was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KontakMasukan  $kontakMasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KontakMasukan $kontakMasukan)
    {
        try {
            $kontakMasukan->delete();

            return redirect()
                ->route('kontak-masukans.index')
                ->with('success', __('The kontakMasukan was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('kontak-masukans.index')
                ->with('error', __("The kontakMasukan can't be deleted because it's related to another table."));
        }
    }
}
