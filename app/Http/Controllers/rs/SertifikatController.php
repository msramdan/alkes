<?php

namespace App\Http\Controllers\rs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{

    public function sertifikat($id)
    {
        return view('scan-sertifikat.index');
    }
}
