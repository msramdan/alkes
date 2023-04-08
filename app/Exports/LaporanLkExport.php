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
        $laporans = DB::table('laporans')
            ->join('pelaksana_teknisis', 'laporans.user_created', '=', 'pelaksana_teknisis.id')
            ->join('faskes', 'laporans.faskes_id', '=', 'faskes.id')
            ->join('users', 'laporans.user_review', '=', 'users.id')
            ->join('nomenklaturs', 'laporans.nomenklatur_id', '=', 'nomenklaturs.id')
            ->select('laporans.*', 'pelaksana_teknisis.nama', 'pelaksana_teknisis.id', 'faskes.nama_faskes', 'faskes.id', 'users.name', 'users.id', 'nomenklaturs.nama_nomenklatur');

        if (isset($this->start_date) && !empty($this->start_date)) {
            $from = date("Y-m-d H:i:s", substr($this->start_date, 0, 10));
            $laporans = $laporans->where('tgl_laporan', '>=', $from);
        } else {
            $from = date('Y-m-d') . " 00:00:00";
            $laporans = $laporans->where('tgl_laporan', '>=', $from);
        }
        if (isset($this->end_date) && !empty($this->end_date)) {
            $to = date("Y-m-d H:i:s", substr($this->end_date, 0, 10));
            $laporans = $laporans->where('tgl_laporan', '<=', $to);
        } else {
            $to = date('Y-m-d') . " 23:59:59";
            $laporans = $laporans->where('tgl_laporan', '<=', $to);
        }

        if (isset($this->teknisi) && !empty($this->teknisi)) {
            if ($this->teknisi != 'All') {
                $laporans = $laporans->where('user_created', $this->teknisi);
            }
        }

        if (isset($this->faskes) && !empty($this->faskes)) {
            if ($this->faskes != 'All') {
                $laporans = $laporans->where('faskes_id', $this->faskes);
            }
        }

        if (isset($this->status) && !empty($this->status)) {
            if ($this->status != 'All') {
                $laporans = $laporans->where('status_laporan', $this->status);
            }
        }
        $laporans = $laporans->orderBy('laporans.id', 'DESC')->get();
        return view('laporans.export', [
            'data' => $laporans
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
