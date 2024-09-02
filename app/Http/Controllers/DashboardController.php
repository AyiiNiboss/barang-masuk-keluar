<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use App\Models\brg_masukModel;
use App\Models\permintaanModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function count(){
        $user = User::where('status', 'ya')->where('rules_id', 2)->get()->count();
        $brg_masuk = brg_masukModel::get()->count();
        $brg_keluar = permintaanModel::where('status', 3)->get()->count();
        $barang = barangModel::get()->count();
        return view('dashboard.dashboard', [
            'data_user' => $user,
            'data_barang_masuk' => $brg_masuk,
            'data_barang_keluar' => $brg_keluar,
            'data_barang' => $barang
        ]);
    }

}
