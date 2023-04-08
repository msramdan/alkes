<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;


class LaporanLkExport implements FromView, ShouldAutoSize, WithEvents
{
    function __construct($start_date, $end_date, $teknisi, $faskes, $status)
    {
        $this->start_date = intval($start_date);
        $this->end_date = intval($end_date);
        $this->teknisi = intval($teknisi);
        $this->faskes = intval($faskes);
        $this->faskes = $status;
    }


    public function view(): View
    {
        $inventaris
            = DB::table('inventaris')
            ->join('rooms', 'inventaris.ruangan_id', '=', 'rooms.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->join('vendors', 'inventaris.vendor_id', '=', 'vendors.id')
            ->select('inventaris.*', 'rooms.nama_ruangan', 'rooms.id', 'brands.nama_merek', 'brands.id', 'types.jenis_alat', 'types.id', 'vendors.nama_vendor', 'vendors.id');


        if (isset($this->ruangan) && !empty($this->ruangan)) {
            if ($this->ruangan != 'All') {
                $inventaris = $inventaris->where('rooms.id', $this->ruangan);
            }
        }
        if (isset($this->merek) && !empty($this->merek)) {
            if ($this->merek != 'All') {
                $inventaris = $inventaris->where('brands.id', $this->merek);
            }
        }
        if (isset($this->jenis_alat) && !empty($this->jenis_alat)) {
            if ($this->jenis_alat != 'All') {
                $inventaris = $inventaris->where('types.id', $this->jenis_alat);
            }
        }

        if (isset($vendor) && !empty($vendor)) {
            if ($this->vendor != 'All') {
                $inventaris = $inventaris->where('vendors.id', $this->vendor);
            }
        }

        $inventaris = $inventaris->orderBy('inventaris.id', 'desc')->get();
        return view('inventaris.export', [
            'data' => $inventaris
        ]);
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:I1'; // All headers
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
