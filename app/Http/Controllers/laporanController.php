<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use Illuminate\Http\Request;
use App\Models\brg_masukModel;
use App\Models\permintaanModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class laporanController extends Controller
{
    public function laporanBarang(){
        $barang = barangModel::take(20)->get();
        return view('laporan.laporan-barang', [
            'data' => $barang
        ]);
    }

    public function searchBarang(Request $request){
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = barangModel::query();
        if ($tanggalAwal) {
            $query->whereDate('created_at', '>=', $tanggalAwal);
        }
        
        if ($tanggalAkhir) {
            $query->whereDate('created_at', '<=', $tanggalAkhir);
        }
        
        $results = $query->get();

        
        if ($request->has('search')) {
            // Proses pencarian data
            return view('laporan.laporan-barang', [
                'data' => $results
            ]);
        } elseif ($request->has('export_pdf')) {
            // Proses ekspor ke PDF
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('laporan.laporan-barang-pdf', ['data' => $results])->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->stream();
        }
    }

    public function laporanBarangMasuk(){
        $barang = brg_masukModel::with('barangRelasi')->get();
        return view('laporan.laporan-barang-masuk', [
            'data' => $barang
        ]);
    }

    public function searchBarangMasuk(Request $request){
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = brg_masukModel::with('barangRelasi');
        if ($tanggalAwal) {
            $query->whereDate('tgl_input', '>=', $tanggalAwal);
        }
        
        if ($tanggalAkhir) {
            $query->whereDate('tgl_input', '<=', $tanggalAkhir);
        }
        
        $results = $query->get();

        
        if ($request->has('search')) {
            // Proses pencarian data
            return view('laporan.laporan-barang-masuk', [
                'data' => $results
            ]);
        } elseif ($request->has('export_pdf')) {
            // Proses ekspor ke PDF
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('laporan.laporan-barang-masuk-pdf', ['data' => $results])->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->stream();
        }
    }

    public function laporanBarangKeluar(){
        $barang = permintaanModel::with(['user','barangRelasi'])->where('status', 3)->get();
        return view('laporan.laporan-barang-keluar', [
            'data' => $barang
        ]);
    }

    public function searchBarangKeluar(Request $request){
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = permintaanModel::with(['user','barangRelasi']);
        if ($tanggalAwal) {
            $query->whereDate('tgl_permintaan', '>=', $tanggalAwal);
        }
        
        if ($tanggalAkhir) {
            $query->whereDate('tgl_permintaan', '<=', $tanggalAkhir);
        }
        
        $results = $query->get();

        
        if ($request->has('search')) {
            // Proses pencarian data
            return view('laporan.laporan-barang-keluar', [
                'data' => $results
            ]);
        } 
        if ($request->has('export_pdf')) {
            // Proses ekspor ke PDF
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('laporan.laporan-barang-keluar-pdf', ['data' => $results])->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->stream();
        }
    }

    public function searchPermintaan(Request $request){
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = permintaanModel::select('user_id','tgl_permintaan', DB::raw('COUNT(*) as jumlah_data'))
        ->with('user')
        ->groupBy('user_id', 'tgl_permintaan')
        ->where('status', 3);
        if ($tanggalAwal) {
            $query->whereDate('tgl_permintaan', '>=', $tanggalAwal);
        }
        
        if ($tanggalAkhir) {
            $query->whereDate('tgl_permintaan', '<=', $tanggalAkhir);
        }
        
        $results = $query->get();

        
        if ($request->has('search')) {
            // Proses pencarian data
            return view('permintaan-sapras.data-brg-keluar', [
                'count' => $results
            ]);
        } 
        if ($request->has('export_pdf')) {
            // Proses ekspor ke PDF
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('permintaan-sapras.laporan-permintaan', ['data' => $results])->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            return $pdf->stream();
        }
    }
}
