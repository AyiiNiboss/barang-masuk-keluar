<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use Illuminate\Http\Request;
use App\Models\kategoriModel;
use Illuminate\Support\Facades\Session;

class kategoriController extends Controller
{
    public function index(){
        $kategori = kategoriModel::all();
        return view('kategori.kategori', [
            'data' => $kategori,
        ]);
    }

    public function store(Request $request){
        $kategori = kategoriModel::create($request->all());
        if($kategori){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Tambah Kategori Sukses !!');
        }
        return redirect('/kategori');
        
    }

    public function update(Request $request, $id){
        $kategori = kategoriModel::FindOrFail($id);
        $kategori->update($request->all());
        if($kategori){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Edit Kategori Sukses !!');
        }
        return redirect('/kategori');
    }

    public function delete($id){
        $kategori = kategoriModel::FindOrFail($id);
        $kategori->delete();
        if($kategori){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Delete Kategori Sukses !!');
        }
        return redirect('/kategori');
    }
}
