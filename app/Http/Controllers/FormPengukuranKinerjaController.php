<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FormPengukuranKinerja;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FormPengukuranKinerjaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {

            if($request->has('preview-table-input')) {
                $request = $request->all();
                return view('form-pengukuran-kinerja.preview', compact('request'));
            }

            $q = FormPengukuranKinerja::orderBy('id', 'DESC')->get();

            return DataTables::of($q)
                ->addIndexColumn()
                ->addColumn('action', 'form-pengukuran-kinerja.include.action')
                ->toJson();
        }
        return view('form-pengukuran-kinerja.index');
    }

    public function create()
    {
        return view('form-pengukuran-kinerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'struktur_input_general' => 'required',
            'struktur_input_table' => 'required',
        ]);

        dd($request->all());
    }
}
