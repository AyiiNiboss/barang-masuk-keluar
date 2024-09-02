<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use Illuminate\Http\Request;
use App\Models\permintaanModel;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfController extends Controller
{
    public function index($tgl_permintaan){
        $permintaan = permintaanModel::with(['user', 'barangRelasi'])->where('tgl_permintaan',$tgl_permintaan)->where('user_id', Auth::user()->id)->where('status', 3)->get();
        $datax = [
            'nama' => Auth::user()->name,
            'users' => $permintaan,
            'tgl' =>$tgl_permintaan
    ];
        $pdf = app('dompdf.wrapper');
        $pdf = PDF::loadView('permintaan-barang.pdf-permintaan-brg', $datax)->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
}
