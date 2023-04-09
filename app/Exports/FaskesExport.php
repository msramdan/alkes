<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;


class FaskesExport implements FromView, ShouldAutoSize, WithEvents
{

    function __construct($jenisFaskes, $kabkots)
    {
        $this->jenisFaskes = intval($jenisFaskes);
        $this->kabkots = intval($kabkots);
    }

    public function view(): View
    {
        $faskes
            = DB::table('faskes')
            ->join('jenis_faskes', 'faskes.jenis_faskes_id', '=', 'jenis_faskes.id')
            ->join('provinces', 'faskes.provinsi_id', '=', 'provinces.id')
            ->join('kabkots', 'faskes.kabkot_id', '=', 'kabkots.id')
            ->join('kecamatans', 'faskes.kecamatan_id', '=', 'kecamatans.id')
            ->join('kelurahans', 'faskes.kelurahan_id', '=', 'kelurahans.id')
            ->select('faskes.*', 'jenis_faskes.nama_jenis_faskes', 'provinces.provinsi', 'kabkots.kabupaten_kota', 'kecamatans.kecamatan', 'kelurahans.kelurahan');

        if (isset($this->jenisFaskes) && !empty($this->jenisFaskes)) {
            if ($this->jenisFaskes != 'All') {
                $faskes = $faskes->where('faskes.jenis_faskes_id', $this->jenisFaskes);
            }
        }
        if (isset($this->kabkots) && !empty($this->kabkots)) {
            if ($this->kabkots != 'All') {
                $faskes = $faskes->where('faskes.kabkot_id', $this->kabkots);
            }
        }
        $faskes = $faskes->orderBy('faskes.id', 'desc')->get();

        return view('faskes.export', [
            'data' => $faskes
        ]);
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
