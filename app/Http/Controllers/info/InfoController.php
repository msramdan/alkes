<?php

namespace App\Http\Controllers\info;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{

    public function sertifikat($id)
    {
        return view('info.sertifikat');
    }

    public function info_inventaris($id)
    {
        $inventaris
            = DB::table('inventaris')
            ->join('rooms', 'inventaris.ruangan_id', '=', 'rooms.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->join('vendors', 'inventaris.vendor_id', '=', 'vendors.id')
            ->select('inventaris.*', 'rooms.nama_ruangan', 'brands.nama_merek', 'types.jenis_alat', 'vendors.nama_vendor')
            ->where('inventaris.id', $id)->first();
        return view('info.info_inventaris', [
            'inventaris' => $inventaris,
        ]);
    }
}
