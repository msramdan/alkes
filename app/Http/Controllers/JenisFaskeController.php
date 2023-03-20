<?php

namespace App\Http\Controllers;

use App\Models\JenisFaske;
use App\Http\Requests\{StoreJenisFaskeRequest, UpdateJenisFaskeRequest};
use Yajra\DataTables\Facades\DataTables;

class JenisFaskeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenis faske view')->only('index', 'show');
        $this->middleware('permission:jenis faske create')->only('create', 'store');
        $this->middleware('permission:jenis faske edit')->only('edit', 'update');
        $this->middleware('permission:jenis faske delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $jenisFaskes = JenisFaske::query();

            return DataTables::of($jenisFaskes)
                ->addColumn('action', 'jenis-faskes.include.action')
                ->toJson();
        }

        return view('jenis-faskes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-faskes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJenisFaskeRequest $request)
    {
        
        JenisFaske::create($request->validated());

        return redirect()
            ->route('jenis-faskes.index')
            ->with('success', __('The jenisFaske was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisFaske  $jenisFaske
     * @return \Illuminate\Http\Response
     */
    public function show(JenisFaske $jenisFaske)
    {
        return view('jenis-faskes.show', compact('jenisFaske'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisFaske  $jenisFaske
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisFaske $jenisFaske)
    {
        return view('jenis-faskes.edit', compact('jenisFaske'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisFaske  $jenisFaske
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJenisFaskeRequest $request, JenisFaske $jenisFaske)
    {
        
        $jenisFaske->update($request->validated());

        return redirect()
            ->route('jenis-faskes.index')
            ->with('success', __('The jenisFaske was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisFaske  $jenisFaske
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisFaske $jenisFaske)
    {
        try {
            $jenisFaske->delete();

            return redirect()
                ->route('jenis-faskes.index')
                ->with('success', __('The jenisFaske was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('jenis-faskes.index')
                ->with('error', __("The jenisFaske can't be deleted because it's related to another table."));
        }
    }
}
