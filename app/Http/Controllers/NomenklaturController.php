<?php

namespace App\Http\Controllers;

use App\Models\Nomenklatur;
use App\Http\Requests\{StoreNomenklaturRequest, UpdateNomenklaturRequest};
use App\Models\Type;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $nomenklaturs = Nomenklatur::orderBy('id', 'DESC')->get();
        $jenis_alat = Type::orderBy('jenis_alat', 'ASC')->get();
        $nomenklatur_fisik_fungsi = DB::table('nomenklatur_kondisi_fisik_fungsi')->where('nomenklatur_id', $nomenklatur->id)->get();
        return view('nomenklaturs.show', compact('nomenklatur', 'jenis_alat', 'nomenklaturs', 'nomenklatur_fisik_fungsi'));
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

    public function save_equipment_type(Request $request)
    {
        $type_id = $request->type_id;
        $nomenklatur_id = $request->nomenklatur_id;
        $pendataan_administrasi = $request->pendataan_administrasi;
        $satuan = $request->satuan;
        $lingkungan = $request->lingkungan;
        $teknis = $request->teknis;
        $keselamatan_listrik = $request->keselamatan_listrik;

        $parameter_pemeriksaan = $request->parameter_pemeriksaan;
        $batas_pemeriksaan = $request->batas_pemeriksaan;
        $pemeriksaan_id = $request->pemeriksaan_id;

        //1. save pendataan_administrasi
        if ($pendataan_administrasi != null) {
            // ambil list data asal
            $cek_pendataan_administrasi = DB::table('nomenklatur_pendataan_administrasi')
                ->where('nomenklatur_id', $nomenklatur_id)->get();
            $listAsal_pendataan_administrasi = [];
            $penambahanBaru_pendataan_administrasi = [];
            foreach ($cek_pendataan_administrasi as $value) {
                array_push($listAsal_pendataan_administrasi, $value->field_pendataan_administrasi);
            }
            foreach ($pendataan_administrasi as $key => $value) {
                // klo tidak ada di asal simpan baru
                if (in_array($value, $listAsal_pendataan_administrasi)) {
                    if ($value == 'Resolusi') {
                        DB::table('nomenklatur_pendataan_administrasi')
                            ->where('nomenklatur_id', $nomenklatur_id)
                            ->where('field_pendataan_administrasi', 'Resolusi')
                            ->update([
                                'satuan' => $satuan[3],
                                'slug'   => Str::slug('Resolusi'),
                            ]);
                    } else if ($value == 'Rentang Ukur') {
                        DB::table('nomenklatur_pendataan_administrasi')
                            ->where('nomenklatur_id', $nomenklatur_id)
                            ->where('field_pendataan_administrasi', 'Rentang Ukur')
                            ->update([
                                'satuan' => $satuan[4],
                                'slug'   => Str::slug('Rentang Ukur'),
                            ]);
                    } else if ($value == 'Kapasitas') {
                        DB::table('nomenklatur_pendataan_administrasi')
                            ->where('nomenklatur_id', $nomenklatur_id)
                            ->where('field_pendataan_administrasi', 'Kapasitas')
                            ->update([
                                'satuan' => $satuan[5],
                                'slug'   => Str::slug('Kapasitas'),
                            ]);
                    }
                } else {
                    if ($value == 'Resolusi') {
                        DB::table('nomenklatur_pendataan_administrasi')->insert([
                            'nomenklatur_id' => $nomenklatur_id,
                            'field_pendataan_administrasi' => $value,
                            'satuan' => $satuan[3],
                            'slug' => Str::slug($value),
                        ]);
                    } else if ($value == 'Rentang Ukur') {
                        DB::table('nomenklatur_pendataan_administrasi')->insert([
                            'nomenklatur_id' => $nomenklatur_id,
                            'field_pendataan_administrasi' => $value,
                            'satuan' => $satuan[4],
                            'slug' => Str::slug($value),
                        ]);
                    } else if ($value == 'Kapasitas') {
                        DB::table('nomenklatur_pendataan_administrasi')->insert([
                            'nomenklatur_id' => $nomenklatur_id,
                            'field_pendataan_administrasi' => $value,
                            'satuan' => $satuan[5],
                            'slug' => Str::slug($value),
                        ]);
                    } else {
                        DB::table('nomenklatur_pendataan_administrasi')->insert([
                            'nomenklatur_id' => $nomenklatur_id,
                            'field_pendataan_administrasi' => $value,
                            'slug' => Str::slug($value),
                        ]);
                    }
                    array_push($penambahanBaru_pendataan_administrasi, $value);
                }
            }
            // cek yg gk ada
            $valueArrayAwal_pendataan_administrasi = array_diff($pendataan_administrasi, $penambahanBaru_pendataan_administrasi);
            $valueArrayAwalDiDelete_pendataan_administrasi = array_diff($listAsal_pendataan_administrasi, $valueArrayAwal_pendataan_administrasi);
            foreach ($valueArrayAwalDiDelete_pendataan_administrasi as $key => $value) {
                DB::table('nomenklatur_pendataan_administrasi')
                    ->where('nomenklatur_id', $nomenklatur_id)
                    ->where('field_pendataan_administrasi', $value)->delete();
            }
        } else {
            DB::table('nomenklatur_pendataan_administrasi')
                ->where('nomenklatur_id', $nomenklatur_id)->delete();
        }

        //2.  save type
        if ($type_id != null) {
            // ambil list data asal
            $cek = DB::table('nomenklatur_type')
                ->where('nomenklatur_id', $nomenklatur_id)->get();
            $listAsal = [];
            $penambahanBaru = [];
            foreach ($cek as $value) {
                array_push($listAsal, $value->type_id);
            }
            foreach ($type_id as $key => $value) {
                // klo tidak ada di asal simpan baru
                if (in_array($value, $listAsal)) {
                } else {
                    DB::table('nomenklatur_type')->insert([
                        'nomenklatur_id' => $nomenklatur_id,
                        'type_id' => $value
                    ]);
                    array_push($penambahanBaru, $value);
                }
            }
            // cek yg gk ada
            $valueArrayAwal = array_diff($type_id, $penambahanBaru);
            $valueArrayAwalDiDelete = array_diff($listAsal, $valueArrayAwal);

            foreach ($valueArrayAwalDiDelete as $key => $value) {
                DB::table('nomenklatur_type')
                    ->where('nomenklatur_id', $nomenklatur_id)
                    ->where('type_id', $value)->delete();
            }
        } else {
            DB::table('nomenklatur_type')
                ->where('nomenklatur_id', $nomenklatur_id)->delete();
        }

        // 3. save PENGUKURAN KONDISI LINGKUNGAN
        if ($lingkungan != null) {
            // ambil list data asal
            $cek_lingkungan = DB::table('nomenklatur_kondisi_lingkungan')
                ->where('nomenklatur_id', $nomenklatur_id)->get();
            $listAsal_lingkungan = [];
            $penambahanBaru_lingkungan = [];
            foreach ($cek_lingkungan as $value) {
                array_push($listAsal_lingkungan, $value->field_kondisi_lingkungan);
            }
            foreach ($lingkungan as $key => $value) {
                // klo tidak ada di asal simpan baru
                if (in_array($value, $listAsal_lingkungan)) {
                } else {
                    DB::table('nomenklatur_kondisi_lingkungan')->insert([
                        'nomenklatur_id' => $nomenklatur_id,
                        'field_kondisi_lingkungan' => $value
                    ]);
                    array_push($penambahanBaru_lingkungan, $value);
                }
            }
            // cek yg gk ada
            $valueArrayAwal_lingkungan = array_diff($lingkungan, $penambahanBaru_lingkungan);
            $valueArrayAwalDiDelete_lingkungan = array_diff($listAsal_lingkungan, $valueArrayAwal_lingkungan);

            foreach ($valueArrayAwalDiDelete_lingkungan as $key => $value) {
                DB::table('nomenklatur_kondisi_lingkungan')
                    ->where('nomenklatur_id', $nomenklatur_id)
                    ->where('field_kondisi_lingkungan', $value)->delete();
            }
        } else {
            DB::table('nomenklatur_kondisi_lingkungan')
                ->where('nomenklatur_id', $nomenklatur_id)->delete();
        }

        // 4. telaah teknis
        if ($teknis != null) {
            // ambil list data asal
            $cek_teknis = DB::table('nomenklatur_telaah_teknis')
                ->where('nomenklatur_id', $nomenklatur_id)->get();
            $listAsal_teknis = [];
            $penambahanBaru_teknis = [];
            foreach ($cek_teknis as $value) {
                array_push($listAsal_teknis, $value->field_telaah_teknis);
            }
            foreach ($teknis as $key => $value) {
                // klo tidak ada di asal simpan baru
                if (in_array($value, $listAsal_teknis)) {
                } else {
                    DB::table('nomenklatur_telaah_teknis')->insert([
                        'nomenklatur_id' => $nomenklatur_id,
                        'field_telaah_teknis' => $value
                    ]);
                    array_push($penambahanBaru_teknis, $value);
                }
            }
            // cek yg gk ada
            $valueArrayAwal_teknis = array_diff($teknis, $penambahanBaru_teknis);
            $valueArrayAwalDiDelete_teknis = array_diff($listAsal_teknis, $valueArrayAwal_teknis);

            foreach ($valueArrayAwalDiDelete_teknis as $key => $value) {
                DB::table('nomenklatur_telaah_teknis')
                    ->where('nomenklatur_id', $nomenklatur_id)
                    ->where('field_telaah_teknis', $value)->delete();
            }
        } else {
            DB::table('nomenklatur_telaah_teknis')
                ->where('nomenklatur_id', $nomenklatur_id)->delete();
        }

        // 5. keselamatan listrik
        if ($keselamatan_listrik != null) {
            // ambil list data asal
            $cek_keselamatan_listrik = DB::table('nomenklatur_keselamatan_listrik')
                ->where('nomenklatur_id', $nomenklatur_id)->get();
            $listAsal_keselamatan_listrik = [];
            $penambahanBaru_keselamatan_listrik = [];
            foreach ($cek_keselamatan_listrik as $value) {
                array_push($listAsal_keselamatan_listrik, $value->field_keselamatan_listrik);
            }
            foreach ($keselamatan_listrik as $key => $value) {
                // klo tidak ada di asal simpan baru
                if (in_array($value, $listAsal_keselamatan_listrik)) {
                } else {
                    DB::table('nomenklatur_keselamatan_listrik')->insert([
                        'nomenklatur_id' => $nomenklatur_id,
                        'field_keselamatan_listrik' => $value
                    ]);
                    array_push($penambahanBaru_keselamatan_listrik, $value);
                }
            }
            // cek yg gk ada
            $valueArrayAwal_keselamatan_listrik = array_diff($keselamatan_listrik, $penambahanBaru_keselamatan_listrik);
            $valueArrayAwalDiDelete_keselamatan_listrik = array_diff($listAsal_keselamatan_listrik, $valueArrayAwal_keselamatan_listrik);

            foreach ($valueArrayAwalDiDelete_keselamatan_listrik as $key => $value) {
                DB::table('nomenklatur_keselamatan_listrik')
                    ->where('nomenklatur_id', $nomenklatur_id)
                    ->where('field_keselamatan_listrik', $value)->delete();
            }
        } else {
            DB::table('nomenklatur_keselamatan_listrik')
                ->where('nomenklatur_id', $nomenklatur_id)->delete();
        }

        // 6. Kondisi Fisik dan fungsi
        if (!empty($parameter_pemeriksaan)) {
            foreach ($parameter_pemeriksaan as $i => $params) {
                if (empty($pemeriksaan_id[$i])) {
                    $fisik_dan_fungsi = DB::table('nomenklatur_kondisi_fisik_fungsi')->insert([
                        'nomenklatur_id' => $nomenklatur_id,
                        'field_parameter' => $parameter_pemeriksaan[$i],
                        'field_batas_pemeriksaan' => $batas_pemeriksaan[$i],
                    ]);
                } else {
                    $fisik_dan_fungsi = DB::table('nomenklatur_kondisi_fisik_fungsi')
                        ->where('id', $pemeriksaan_id[$i])
                        ->update([
                            'nomenklatur_id' => $nomenklatur_id,
                            'field_parameter' => $parameter_pemeriksaan[$i],
                            'field_batas_pemeriksaan' => $batas_pemeriksaan[$i],
                        ]);
                }
            }
        }

        $listAsal = [];
        $listAsal_teknis = [];
        $penambahanBaru = [];
        $penambahanBaru_teknis = [];
        $listAsal_pendataan_administrasi = [];
        $penambahanBaru_pendataan_administrasi = [];
        $listAsal_lingkungan = [];
        $penambahanBaru_lingkungan = [];

        return redirect()
            ->route('nomenklaturs.index')
            ->with('success', __('Jenis alat untuk nomenklatur berhasil diupdate'));
    }

    public function deletePemeriksaan(Request $request)
    {
        $pemeriksaan = DB::table('nomenklatur_kondisi_fisik_fungsi')
            ->where('id', $request->pemeriksaan_id)
            ->delete();
        if ($pemeriksaan) {
            return response()->json([
                'success' => true,
                'message' => 'Succes delete pemeriksaan kondisi fisik dan fungsi',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete pemeriksaan kondisi fisik dan fungsi'
            ], 500);
        }
    }
}
