<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaTeknisi;
use App\Http\Requests\{StorePelaksanaTeknisiRequest, UpdatePelaksanaTeknisiRequest};
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PelaksanaTeknisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pelaksana teknis view')->only('index', 'show');
        $this->middleware('permission:pelaksana teknis create')->only('create', 'store');
        $this->middleware('permission:pelaksana teknis edit')->only('edit', 'update');
        $this->middleware('permission:pelaksana teknis delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $pelaksanaTeknisis = PelaksanaTeknisi::orderBy('id', 'DESC')->get();
            return DataTables::of($pelaksanaTeknisis)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    $photo = Storage::url('public/img/teknisi/');
                    return asset($photo . $row->photo);
                })
                ->addColumn('action', 'pelaksana-teknisis.include.action')
                ->toJson();
        }

        return view('pelaksana-teknisis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelaksana-teknisis.create');
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
                'nama' => 'required|string|min:1|max:200',
                'jenis_kelamin' => 'required',
                'no_telpon' => 'required|string|min:1|max:15',
                'email' => 'required|string|min:1|max:200',
                'tempat_lahir' => 'required|string|min:1|max:100',
                'tangal_lahir' => 'required|date',
                'photo' => 'required|image|mimes:png,jpg,jpeg',
                'password' => 'required|string|min:1|max:200',
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            //upload image
            $photo = $request->file('photo');
            $photo->storeAs('public/img/teknisi', $photo->hashName());
            $data = [
                'nama'                  => $request->nama,
                'jenis_kelamin'         => $request->jenis_kelamin,
                'no_telpon'             => $request->no_telpon,
                'email'                 => $request->email,
                'tempat_lahir'          => $request->tempat_lahir,
                'tangal_lahir'          => $request->tangal_lahir,
                'password'              => bcrypt($request->password),
                'photo'                 => $photo->hashName(),
            ];
            // dd($data);

            PelaksanaTeknisi::create($data);
            return redirect()
                ->route('pelaksana-teknis.index')
                ->with('success', __('The pelaksanaTeknisi was created successfully.'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('pelaksana-teknis.index')
                ->with('error', __('Data failed to save'));
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function show(PelaksanaTeknisi $pelaksanaTeknisi)
    {
        return view('pelaksana-teknisis.show', compact('pelaksanaTeknisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelaksanaTeknisi = PelaksanaTeknisi::findOrFail($id);
        return view('pelaksana-teknisis.edit', compact('pelaksanaTeknisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|string|min:1|max:200',
                'jenis_kelamin' => 'required',
                'no_telpon' => 'required|string|min:1|max:15',
                'email' => 'required|string|min:1|max:200',
                'tempat_lahir' => 'required|string|min:1|max:100',
                'tangal_lahir' => 'required|date',
                'photo' => 'image|mimes:png,jpg,jpeg',
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $teknisi = PelaksanaTeknisi::findOrFail($id);
        if ($request->file('photo') != null || $request->file('photo') != '') {
            Storage::disk('local')->delete('public/img/teknisi/' . $teknisi->photo);
            $photo = $request->file('photo');
            $photo->storeAs('public/img/teknisi', $photo->hashName());
            $teknisi->update([
                'photo'     => $photo->hashName(),
            ]);
        }

        $teknisi->update([
            'nama'                  => $request->nama,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'no_telpon'             => $request->no_telpon,
            'email'                 => $request->email,
            'tempat_lahir'          => $request->tempat_lahir,
            'tangal_lahir'          => $request->tangal_lahir,
            'password'              => bcrypt($request->password),
        ]);


        return redirect()
            ->route('pelaksana-teknis.index')
            ->with('success', __('The pelaksanaTeknisi was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelaksanaTeknisi  $pelaksanaTeknisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek = PelaksanaTeknisi::findOrFail($id);
            Storage::disk('local')->delete('public/img/teknisi/' . $cek->photo);
            PelaksanaTeknisi::where('id', $id)->delete();
            return redirect()
                ->route('pelaksana-teknis.index')
                ->with('success', __('The pelaksanaTeknisi was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('pelaksana-teknis.index')
                ->with('error', __("The pelaksanaTeknisi can't be deleted because it's related to another table."));
        }
    }
}
