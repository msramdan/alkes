<?php

namespace App\Http\Controllers;

use App\Exports\LaporanLkExport;
use App\Models\Laporan;
use App\Http\Requests\{StoreLaporanRequest, UpdateLaporanRequest};
use Yajra\DataTables\Facades\DataTables;
use App\Models\PelaksanaTeknisi;
use App\Models\Faske;
use App\Models\Nomenklatur;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Validator;
use App\Helper\StringHelper;
use Alert;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:laporan view')->only('index', 'show');
        $this->middleware('permission:laporan edit')->only('edit', 'update');
        $this->middleware('permission:laporan delete')->only('destroy');
        $this->middleware('permission:laporan create')->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $start_date = intval($request->query('start_date'));
            $end_date = intval($request->query('end_date'));
            $teknisi = $request->query('teknisi');
            $faskes = intval($request->query('faskes'));
            $status = $request->query('status');

            $laporans = DB::table('laporans')
                ->leftjoin('pelaksana_teknisis', 'laporans.user_created', '=', 'pelaksana_teknisis.id')
                ->leftjoin('faskes', 'laporans.faskes_id', '=', 'faskes.id')
                ->leftjoin('users', 'laporans.user_review', '=', 'users.id')
                ->leftjoin('nomenklaturs', 'laporans.nomenklatur_id', '=', 'nomenklaturs.id')
                ->select('laporans.*', 'pelaksana_teknisis.nama', 'faskes.nama_faskes', 'users.name', 'nomenklaturs.nama_nomenklatur');
            if (isset($start_date) && !empty($start_date)) {
                $from = date("Y-m-d H:i:s", substr($request->query('start_date'), 0, 10));
                $laporans = $laporans->where('tgl_laporan', '>=', $from);
            } else {
                $from = date('Y-m-d') . " 00:00:00";
                $laporans = $laporans->where('tgl_laporan', '>=', $from);
            }

            if (isset($end_date) && !empty($end_date)) {
                $to = date("Y-m-d H:i:s", substr($request->query('end_date'), 0, 10));
                $laporans = $laporans->where('tgl_laporan', '<=', $to);
            } else {
                $to = date('Y-m-d') . " 23:59:59";
                $laporans = $laporans->where('tgl_laporan', '<=', $to);
            }

            if (isset($start_date) && !empty($start_date) && isset($end_date) && !empty($end_date)) {
                $from = date("Y-m-d H:i:s", substr($request->query('start_date'), 0, 10));
                $to = date("Y-m-d H:i:s", substr($request->query('end_date'), 0, 10));
                $laporans = $laporans->whereBetween('tgl_laporan', [$from, $to]);
            } else {
                $from = date('Y-m-d') . " 00:00:00";
                $to = date('Y-m-d') . " 23:59:59";
                $laporans = $laporans->whereBetween('tgl_laporan', [$from, $to]);
            }

            if (isset($teknisi) && !empty($teknisi)) {
                if ($teknisi != 'All') {
                    $laporans = $laporans->where('user_created', $teknisi);
                }
            }

            if (isset($faskes) && !empty($faskes)) {
                if ($faskes != 'All') {
                    $laporans = $laporans->where('faskes_id', $faskes);
                }
            }

            if (isset($status) && !empty($status)) {
                if ($status != 'All') {
                    $laporans = $laporans->where('status_laporan', $status);
                }
            }

            $laporans = $laporans->orderBy('laporans.id', 'DESC')->get();

            return DataTables::of($laporans)
                ->addIndexColumn()
                ->addColumn('user_created', function ($row) {
                    return $row->nama;
                })->addColumn('user_review', function ($row) {
                    return $row->name;
                })->addColumn('action', 'laporans.include.action')
                ->toJson();
        }

        $from = date('Y-m-d') . " 00:00:00";
        $to = date('Y-m-d') . " 23:59:59";
        $microFrom = strtotime($from) * 1000;
        $microTo = strtotime($to) * 1000;
        $pelaksanaTeknisis = PelaksanaTeknisi::orderBy('id', 'DESC')->get();
        $faskes = Faske::orderBy('id', 'DESC')->get();
        return view('laporans.index', [
            'microFrom' => $microFrom,
            'microTo' => $microTo,
            'pelaksanaTeknisis' => $pelaksanaTeknisis,
            'faskes' => $faskes,
        ]);
    }

    public function create()
    {
        $PelaksanaTeknisi = PelaksanaTeknisi::orderBy('nama', 'ASC')->get();
        $number = StringHelper::generateZeroIndexNumberWithPrefixFromDB(new Laporan(), 'LAP', 'no_laporan');
        return view('laporans.create', [
            'no_laporan' => $number,
            'PelaksanaTeknisi' => $PelaksanaTeknisi
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'no_laporan' => "required|unique:laporans,no_laporan",
                'user_created' => "required",
            ],
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::table('laporans')->insert([
            'no_laporan' => $request->no_laporan,
            'user_created' => $request->user_created,
            'status_laporan' => "Initial",
            'tgl_laporan' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->route('laporans.index')
            ->with('success', __('Assign Laporan was created successfully.'));
    }

    public function show(Laporan $laporan)
    {
        $laporan->load('user:id,name', 'user:id,name',);

        return view('laporans.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $PelaksanaTeknisi = PelaksanaTeknisi::orderBy('nama', 'ASC')->get();
        return view('laporans.edit', [
            'no_laporan' => $laporan->no_laporan,
            'laporan' => $laporan,
            'PelaksanaTeknisi' => $PelaksanaTeknisi
        ]);
    }

    public function update(Request $request, Laporan $laporan)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'no_laporan' => "required|unique:laporans,no_laporan," . $laporan->id,
                'user_created' => "required",
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $laporan = Laporan::findOrFail($laporan->id);
        $laporan->update([
            'nomenklatur_id' => $request->nomenklatur_id,
            'user_created' => $request->user_created,
            'tgl_laporan' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->route('laporans.index')
            ->with('success', __('The laporan was updated successfully.'));
    }

    public function destroy(Laporan $laporan)
    {
        try {
            $laporan->delete();

            return redirect()
                ->route('laporans.index')
                ->with('success', __('The laporan was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('laporans.index')
                ->with('error', __("The laporan can't be deleted because it's related to another table."));
        }
    }

    public function export($start_date, $end_date, $teknisi, $faskes, $status)
    {
        $date = date('d-m-Y');
        $nameFile = 'Laporan_Lk' . $date;
        return Excel::download(new LaporanLkExport($start_date, $end_date, $teknisi, $faskes, $status), $nameFile . '.xlsx');
    }

    public function pdf_lk($id)
    {
        $laporan = DB::table('laporans')
            ->join('pelaksana_teknisis', 'laporans.user_created', '=', 'pelaksana_teknisis.id')
            ->leftjoin('users', 'laporans.user_review', '=', 'users.id')
            ->select('laporans.*', 'pelaksana_teknisis.nama as nama_teknisi', 'users.name as name_user')
            ->where('laporans.id', $id)
            ->first();

        $nomenklaturs = Nomenklatur::find($laporan->nomenklatur_id);
        $laporan_pendataan_administrasi =
            DB::table('laporan_pendataan_administrasi')
            ->join('nomenklatur_pendataan_administrasi', 'laporan_pendataan_administrasi.slug', '=', 'nomenklatur_pendataan_administrasi.slug')
            ->select('laporan_pendataan_administrasi.*', 'nomenklatur_pendataan_administrasi.satuan',)
            ->where('no_laporan', $laporan->no_laporan)
            ->where('nomenklatur_id', $laporan->nomenklatur_id)
            ->get();

        $dataAwal = ceil(count($laporan_pendataan_administrasi) / 2);
        $laporan_daftar_alat_ukur =
            DB::table('laporan_daftar_alat_ukur')
            ->join('inventaris', 'laporan_daftar_alat_ukur.inventaris_id', '=', 'inventaris.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->select('inventaris.*', 'brands.nama_merek', 'types.jenis_alat')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $laporan_telaah_teknis =
            DB::table('laporan_telaah_teknis')
            ->select('laporan_telaah_teknis.*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $laporan_kesimpulan_telaah_teknis =
            DB::table('laporan_kesimpulan_telaah_teknis')
            ->select('laporan_kesimpulan_telaah_teknis.*')
            ->where('no_laporan', $laporan->no_laporan)
            ->first();
        $laporan_kondisi_lingkungan = DB::table('laporan_kondisi_lingkungan')->where('no_laporan', $laporan->no_laporan)->first();
        $kondisi_fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')->where('no_laporan', $laporan->no_laporan)->get();
        $laporan_pengukuran_keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
            ->select('*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $count_laporan_pengukuran_keselamatan_listrik = count($laporan_pengukuran_keselamatan_listrik);
        $pdf = PDF::loadview('laporans.pdf_lk', [
            'laporan' => $laporan,
            'nomenklaturs' => $nomenklaturs,
            'laporan_pendataan_administrasi' => $laporan_pendataan_administrasi,
            'dataAwal' => $dataAwal,
            'laporan_daftar_alat_ukur' => $laporan_daftar_alat_ukur,
            'kondisi_fisik_fungsi' => $kondisi_fisik_fungsi,
            'laporan_kondisi_lingkungan' => $laporan_kondisi_lingkungan,
            'laporan_telaah_teknis' => $laporan_telaah_teknis,
            'laporan_kesimpulan_telaah_teknis' => $laporan_kesimpulan_telaah_teknis,
            'laporan_pengukuran_keselamatan_listrik' => $laporan_pengukuran_keselamatan_listrik,
            'count_laporan_pengukuran_keselamatan_listrik' => $count_laporan_pengukuran_keselamatan_listrik
        ]);
        return $pdf->stream();
        // return $pdf->download('Lembar-Kerja');
    }

    public function pdf_lk_scorsing($id)
    {
        $laporan = DB::table('laporans')
            ->join('pelaksana_teknisis', 'laporans.user_created', '=', 'pelaksana_teknisis.id')
            ->leftjoin('users', 'laporans.user_review', '=', 'users.id')
            ->select('laporans.*', 'pelaksana_teknisis.nama as nama_teknisi', 'users.name as name_user')
            ->where('laporans.id', $id)
            ->first();

        $nomenklaturs = Nomenklatur::find($laporan->nomenklatur_id);
        $laporan_pendataan_administrasi =
            DB::table('laporan_pendataan_administrasi')
            ->join('nomenklatur_pendataan_administrasi', 'laporan_pendataan_administrasi.slug', '=', 'nomenklatur_pendataan_administrasi.slug')
            ->select('laporan_pendataan_administrasi.*', 'nomenklatur_pendataan_administrasi.satuan',)
            ->where('no_laporan', $laporan->no_laporan)
            ->where('nomenklatur_id', $laporan->nomenklatur_id)
            ->get();

        $dataAwal = ceil(count($laporan_pendataan_administrasi) / 2);
        $laporan_daftar_alat_ukur =
            DB::table('laporan_daftar_alat_ukur')
            ->join('inventaris', 'laporan_daftar_alat_ukur.inventaris_id', '=', 'inventaris.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->select('inventaris.*', 'brands.nama_merek', 'types.jenis_alat')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $laporan_telaah_teknis =
            DB::table('laporan_telaah_teknis')
            ->select('laporan_telaah_teknis.*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $laporan_kesimpulan_telaah_teknis =
            DB::table('laporan_kesimpulan_telaah_teknis')
            ->select('laporan_kesimpulan_telaah_teknis.*')
            ->where('no_laporan', $laporan->no_laporan)
            ->first();
        $laporan_kondisi_lingkungan = DB::table('laporan_kondisi_lingkungan')->where('no_laporan', $laporan->no_laporan)->first();
        $kondisi_fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')->where('no_laporan', $laporan->no_laporan)->get();
        $count_kondisi_fisik_fungsi = count($kondisi_fisik_fungsi);

        $kondisi_fisik_fungsi_baik = DB::table('laporan_kondisi_fisik_fungsi')
            ->where('no_laporan', $laporan->no_laporan)
            ->where('value', 'baik')->get();
        $score_fisik = (count($kondisi_fisik_fungsi_baik) / count($kondisi_fisik_fungsi)) * 10;



        $laporan_pengukuran_keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
            ->select('*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $count_laporan_pengukuran_keselamatan_listrik = count($laporan_pengukuran_keselamatan_listrik);
        $pdf = PDF::loadview('laporans.pdf_lk_scorsing', [
            'laporan' => $laporan,
            'nomenklaturs' => $nomenklaturs,
            'laporan_pendataan_administrasi' => $laporan_pendataan_administrasi,
            'dataAwal' => $dataAwal,
            'laporan_daftar_alat_ukur' => $laporan_daftar_alat_ukur,
            'kondisi_fisik_fungsi' => $kondisi_fisik_fungsi,
            'laporan_kondisi_lingkungan' => $laporan_kondisi_lingkungan,
            'laporan_telaah_teknis' => $laporan_telaah_teknis,
            'laporan_kesimpulan_telaah_teknis' => $laporan_kesimpulan_telaah_teknis,
            'laporan_pengukuran_keselamatan_listrik' => $laporan_pengukuran_keselamatan_listrik,
            'count_kondisi_fisik_fungsi' => $count_kondisi_fisik_fungsi,
            'score_fisik' => round($score_fisik, 2),
            'count_laporan_pengukuran_keselamatan_listrik' => $count_laporan_pengukuran_keselamatan_listrik
        ]);
        return $pdf->stream();
    }

    public function pdf_lk_laporan($id)
    {
        $laporan = DB::table('laporans')
            ->join('pelaksana_teknisis', 'laporans.user_created', '=', 'pelaksana_teknisis.id')
            ->leftjoin('users', 'laporans.user_review', '=', 'users.id')
            ->select('laporans.*', 'pelaksana_teknisis.nama as nama_teknisi', 'users.name as name_user')
            ->where('laporans.id', $id)
            ->first();

        $nomenklaturs = Nomenklatur::find($laporan->nomenklatur_id);
        $laporan_pendataan_administrasi =
            DB::table('laporan_pendataan_administrasi')
            ->join('nomenklatur_pendataan_administrasi', 'laporan_pendataan_administrasi.slug', '=', 'nomenklatur_pendataan_administrasi.slug')
            ->select('laporan_pendataan_administrasi.*', 'nomenklatur_pendataan_administrasi.satuan',)
            ->where('no_laporan', $laporan->no_laporan)
            ->where('nomenklatur_id', $laporan->nomenklatur_id)
            ->get();

        $dataAwal = ceil(count($laporan_pendataan_administrasi) / 2);
        $laporan_daftar_alat_ukur =
            DB::table('laporan_daftar_alat_ukur')
            ->join('inventaris', 'laporan_daftar_alat_ukur.inventaris_id', '=', 'inventaris.id')
            ->join('brands', 'inventaris.merk_id', '=', 'brands.id')
            ->join('types', 'inventaris.jenis_alat_id', '=', 'types.id')
            ->select('inventaris.*', 'brands.nama_merek', 'types.jenis_alat')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $laporan_telaah_teknis =
            DB::table('laporan_telaah_teknis')
            ->select('laporan_telaah_teknis.*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $laporan_kesimpulan_telaah_teknis =
            DB::table('laporan_kesimpulan_telaah_teknis')
            ->select('laporan_kesimpulan_telaah_teknis.*')
            ->where('no_laporan', $laporan->no_laporan)
            ->first();
        $laporan_kondisi_lingkungan = DB::table('laporan_kondisi_lingkungan')->where('no_laporan', $laporan->no_laporan)->first();
        $kondisi_fisik_fungsi = DB::table('laporan_kondisi_fisik_fungsi')->where('no_laporan', $laporan->no_laporan)->get();
        $laporan_pengukuran_keselamatan_listrik = DB::table('laporan_pengukuran_keselamatan_listrik')
            ->select('*')
            ->where('no_laporan', $laporan->no_laporan)
            ->get();
        $count_laporan_pengukuran_keselamatan_listrik = count($laporan_pengukuran_keselamatan_listrik);
        $pdf = PDF::loadview('laporans.pdf_laporan', [
            'laporan' => $laporan,
            'nomenklaturs' => $nomenklaturs,
            'laporan_pendataan_administrasi' => $laporan_pendataan_administrasi,
            'dataAwal' => $dataAwal,
            'laporan_daftar_alat_ukur' => $laporan_daftar_alat_ukur,
            'kondisi_fisik_fungsi' => $kondisi_fisik_fungsi,
            'laporan_kondisi_lingkungan' => $laporan_kondisi_lingkungan,
            'laporan_telaah_teknis' => $laporan_telaah_teknis,
            'laporan_kesimpulan_telaah_teknis' => $laporan_kesimpulan_telaah_teknis,
            'laporan_pengukuran_keselamatan_listrik' => $laporan_pengukuran_keselamatan_listrik,
            'count_laporan_pengukuran_keselamatan_listrik' => $count_laporan_pengukuran_keselamatan_listrik
        ]);
        return $pdf->stream();
        // return $pdf->download('Lembar-Kerja');
    }

    public function pdf_sertifikat($id)
    {
        $getLaporan = Laporan::find($id);

        if ($getLaporan->status_laporan == 'Approved') {
            $faskes = Faske::findOrFail($getLaporan->faskes_id);
            $nomenklatur = Nomenklatur::findOrFail($getLaporan->nomenklatur_id);
            $merk = DB::table('laporan_pendataan_administrasi')
                ->where('no_laporan', $getLaporan->no_laporan)
                ->where('field_pendataan_administrasi', 'Merk')
                ->first();
            $sn = DB::table('laporan_pendataan_administrasi')
                ->where('no_laporan', $getLaporan->no_laporan)
                ->where('field_pendataan_administrasi', 'Nomor Seri')
                ->first();

            $pdf = Pdf::loadview('laporans/sertifikat', [
                'laporan' =>  $getLaporan,
                'faskes' =>  $faskes,
                'nomenklatur' =>  $nomenklatur,
                'merk' =>  $merk->value,
                'sn' =>  $sn->value,
                'tgl' => substr($getLaporan->tgl_review, 0, 10),
            ]);
            // set paper size
            $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait');
            // set padding and margin to 0
            $pdf->setOption('margin-top', 0);
            $pdf->setOption('margin-right', 0);
            $pdf->setOption('margin-bottom', 0);
            $pdf->setOption('margin-left', 0);
            return $pdf->stream('laporan-sertifikat.pdf');
        } else {
            alert()->error('Error', 'The certificate is not yet available if the status is Need Review and Rejected.');
            return back();
        }
    }

    public function updateStatus(Request $request)
    {
        $laporan = Laporan::findOrFail($request->id);
        $laporan->update([
            'catatan' => $request->catatan,
            'user_review' => auth()->user()->id,
            'tgl_review' => date('Y-m-d H:i:s'),
            'status_laporan' => $request->status_laporan,
        ]);
        return redirect()
            ->route('laporans.index')
            ->with('success', __('Status laporan kerja was updated successfully.'));
    }

    public function qr_layak($id)
    {
        $hightPaper = 207;
        $width = 112;
        $widthQR = 114;
        $laporan = DB::table('laporans')
            ->where('id', $id)
            ->first();
        $pdf = PDF::loadview('laporans.qr_layak', [
            'laporan' => $laporan,
            'widthQR' => $widthQR
        ])->setPaper([0, 0, $hightPaper, $width], 'landscape');
        return $pdf->stream();
    }

    public function qr_tidak_layak($id)
    {
        $hightPaper = 207;
        $width = 112;
        $widthQR = 114;
        $laporan = DB::table('laporans')
            ->where('id', $id)
            ->first();
        $pdf = PDF::loadview('laporans.qr_tidak_layak', [
            'laporan' => $laporan,
            'widthQR' => $widthQR
        ])->setPaper([0, 0, $hightPaper,  $width], 'landscape');;
        return $pdf->stream();
    }
}
