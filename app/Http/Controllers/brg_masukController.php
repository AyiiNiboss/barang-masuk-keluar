<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use Illuminate\Http\Request;
use App\Models\brg_masukModel;
use Illuminate\Support\Facades\Session;

class brg_masukController extends Controller
{
    public function index(){
        $brg_masuk = brg_masukModel::with('barangRelasi')->OrderBy('id', 'DESC')->get();
        return view('barang masuk.barang_masuk',[
            'data' => $brg_masuk
        ]);
    }

    public function create(){
        $barang = barangModel::get();
        return view('barang masuk.barang_masuk_add', [
            'data_barang' => $barang
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'barang_id' => 'required',
            'tgl_input' => 'required',
            'stock' => 'required',
            'harga' => 'required'
        ]);

        $id_barang = $request->barang_id;
        $stock_1 = $request->stock;
        $barang = barangModel::FindOrFail($id_barang);
        $stock_2 = $barang->stock;
        $stock_new = $stock_1 + $stock_2;
        $barang->stock = $stock_new;
        $barang->save();
        $brg_masuk = brg_masukModel::create($request->all());
        if($brg_masuk){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Tambah Barang Masuk Sukses !!');
        }
        return redirect('/barang_masuk');
    }

    public function edit(Request $request, $id){
        $brg_masuk = brg_masukModel::with('barangRelasi')->FindOrFail($id);
        $barang = barangModel::all();
        return view('barang masuk.barang_masuk_edit', [
            'data' => $brg_masuk,
            'data_barang' => $barang
        ]);
    }

    public function update(Request $request, $id){
        $barang_masuk = brg_masukModel::with('barangRelasi')->FindOrFail($id);
        $stock_barang_masuk_now = $barang_masuk->stock;

        $barang = barangModel::FindOrFail($barang_masuk->barang_id);
        $stock_barang_now = $barang->stock;  
        $stock_barang_yg_diubah = $request->stock;

        $stock_barang_new = $stock_barang_now + $stock_barang_yg_diubah - $stock_barang_masuk_now;

        if($stock_barang_new >= 0){
            $barang->stock = $stock_barang_new;
            $barang->save();
        }

        $barang_masuk->update($request->all());
        if($barang_masuk){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Edit Data Barang Masuk Sukses !!');
        }
        return redirect('/barang_masuk');
    }

    public function delete($id){
        $barang_masuk = brg_masukModel::FindOrFail($id);
        $barang = barangModel::FindOrFail($barang_masuk->barang_id);
        $stock_barang_masuk = $barang_masuk->stock;
        $stock_barang = $barang->stock;

        $stock_new = $stock_barang - $stock_barang_masuk;
        $barang->stock = $stock_new;
        $barang->save();

        $barang_masuk->delete();
        if($barang_masuk){
            Session::flash('status', 'success');
            Session::flash('pesan' , 'Data Barang Masuk Berhasil Dihapus !!');
        }
        return redirect('/barang_masuk');
    }
}
