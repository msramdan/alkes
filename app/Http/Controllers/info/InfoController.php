<?php

namespace App\Http\Controllers\info;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    public function sertifikat($id)
    {
        return view('info.sertifikat');
    }

    public function info_inventaris($id)
    {
        return view('info.info_inventaris');
    }
}
