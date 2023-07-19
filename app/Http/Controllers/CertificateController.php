<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function show() {
        $pdf = Pdf::loadview('laporans/sertifikat');
        // set paper size
        $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait');
        // set padding and margin to 0
        $pdf->setOption('margin-top', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->setOption('margin-bottom', 0);
        $pdf->setOption('margin-left', 0);

        return $pdf->stream('laporan-sertifikat.pdf');
    }
}
