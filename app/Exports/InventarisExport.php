<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class InventarisExport implements FromView, ShouldAutoSize, WithEvents
{
    function __construct($ruangan, $merek, $jenis_alat, $vendor)
    {
        $this->ruangan = intval($ruangan);
        $this->merek = intval($merek);
        $this->jenis_alat = intval($jenis_alat);
        $this->vendor = intval($vendor);
    }

    public function view(): View
    {
        $inventaris
            = DB::table('inventaris')
            ->join('rooms', 'inventaris.ruangan_id', '=', 'rooms.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->join('vendors', 'inventaris.vendor_id', '=', 'vendors.id')
            ->select('inventaris.*', 'rooms.nama_ruangan', 'brands.nama_merek', 'types.jenis_alat', 'vendors.nama_vendor');

        if (isset($this->ruangan) && !empty($this->ruangan)) {
            if ($this->ruangan != 'All') {
                $inventaris = $inventaris->where('inventaris.ruangan_id', $this->ruangan);
            }
        }
        if (isset($this->merek) && !empty($this->merek)) {
            if ($this->merek != 'All') {
                $inventaris = $inventaris->where('inventaris.merk_id', $this->merek);
            }
        }
        if (isset($this->jenis_alat) && !empty($this->jenis_alat)) {
            if ($this->jenis_alat != 'All') {
                $inventaris = $inventaris->where('inventaris.jenis_alat_id', $this->jenis_alat);
            }
        }

        if (isset($this->vendor) && !empty($this->vendor)) {
            if ($this->vendor != 'All') {
                $inventaris = $inventaris->where('inventaris.vendor_id', $this->vendor);
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
