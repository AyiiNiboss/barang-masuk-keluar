<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use App\Models\kategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class barangController extends Controller
{
    public function index(){
        $barang = barangModel::with('kategori')->OrderBy('id', 'DESC')->get();
        return view('barang.barang', [
            'data' => $barang
        ]);
    }

    public function create(){
        $kategori = kategoriModel::all();
        return view('barang.barang-add', [
            'data' => $kategori
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'kode_barang' => 'required|unique:barang',
            'nama_barang' => 'required',
            'stock' => 'required',
            'harga' => 'required'
        ]);
        $request['kode_barang'] = $request->kode_barang;
        $request['nama_barang'] = $request->nama_barang;
        $request['stock'] = $request->stock;
        $request['harga'] = $request->harga;

        $tambah = barangModel::create($request->all());
        if($tambah){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Tambah Data Barang Sukses !!');
        }
        return redirect('/barang');
    }

    public function edit(Request $request, $id){
        $barang = barangModel::FindOrFail($id);
        $kategori = kategoriModel::all();
        return view('barang.barang-edit', [
            'data' => $barang,
            'dataKategori' => $kategori
        ]);
    }

    public function update(Request $request, $id){
        
        $barang = barangModel::FindOrFail($id);
        $barang->update($request->all());
        if($barang){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Edit Data Barang Sukses !!');
        }
        return redirect('/barang');

    }

    public function delete($id){
        $barang = barangModel::FindOrFail($id);
        $barang->delete();
        if($barang){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Hapus user sukses !!');
        }
        return redirect('/barang');
    }
}
