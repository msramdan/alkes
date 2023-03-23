<?php

namespace App\Http\Controllers;

use App\Models\Nomenklatur;
use App\Http\Requests\{StoreNomenklaturRequest, UpdateNomenklaturRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
                ->addColumn('metode_kerja', function ($row) {
                    return  '<button class="btn btn-success btn btn-sm view_dokumen" type="button" data-bs-toggle="modal" id=""
                        data-metode_kerja="' . $row->metode_kerja . '" data-bs-target="#backdrop"> <i
                            class="fa fa-file"></i>
                        View
                    </button>';
                })
                ->addColumn('action', 'nomenklaturs.include.action')
                ->rawColumns(['metode_kerja', 'action'])
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
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nama_nomenklatur' => 'required|string|min:1|max:255',
                'no_dokumen' => 'required|string|min:1|max:255',
                'metode_kerja' => "required|mimes:pdf|max:10000"
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            $metode_kerja = $request->file('metode_kerja');
            $metode_kerja->storeAs('public/img/metode_kerja', $metode_kerja->hashName());

            Nomenklatur::create([
                'nama_nomenklatur' => $request->nama_nomenklatur,
                'no_dokumen' => $request->no_dokumen,
                'metode_kerja'     => $metode_kerja->hashName(),
            ]);
            return redirect()
                ->route('nomenklaturs.index')
                ->with('success', __('The nomenklatur was created successfully.'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('nomenklaturs.index')
                ->with('error', __('Data failed to save'));
        } finally {
            DB::commit();
        }
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
    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nama_nomenklatur' => 'required|string|min:1|max:255',
                'no_dokumen' => 'required|string|min:1|max:255',
                'metode_kerja' => "mimes:pdf|max:10000"
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $banner = Nomenklatur::findOrFail($id);
        if ($request->file('metode_kerja') != null || $request->file('metode_kerja') != '') {
            Storage::disk('local')->delete('public/img/metode_kerja/' . $banner->metode_kerja);
            $metode_kerja = $request->file('metode_kerja');
            $metode_kerja->storeAs('public/img/metode_kerja', $metode_kerja->hashName());
            $banner->update([
                'metode_kerja'     => $metode_kerja->hashName(),
            ]);
        }
        $banner->update([
            'nama_nomenklatur' => $request->nama_nomenklatur,
            'no_dokumen' => $request->no_dokumen,
        ]);
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
            if ($nomenklatur->delete()) {
                Storage::disk('local')->delete('public/img/metode_kerja/' . $nomenklatur->metode_kerja);
            }
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
