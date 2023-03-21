<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Requests\{StoreTypeRequest, UpdateTypeRequest};
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:type view')->only('index', 'show');
        $this->middleware('permission:type create')->only('create', 'store');
        $this->middleware('permission:type edit')->only('edit', 'update');
        $this->middleware('permission:type delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $types = Type::orderBy('id', 'DESC')->get();
            return DataTables::of($types)
                ->addIndexColumn()
                ->addColumn('action', 'types.include.action')
                ->toJson();
        }

        return view('types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {

        Type::create($request->validated());

        return redirect()
            ->route('types.index')
            ->with('success', __('The type was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {

        $type->update($request->validated());

        return redirect()
            ->route('types.index')
            ->with('success', __('The type was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        try {
            $type->delete();

            return redirect()
                ->route('types.index')
                ->with('success', __('The type was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('types.index')
                ->with('error', __("The type can't be deleted because it's related to another table."));
        }
    }
}
