<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\barangModel;
use Illuminate\Http\Request;
use App\Models\sementaraModel;
use App\Models\permintaanModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class permintaanController extends Controller
{
    public function index(){
        $permintaanCount = permintaanModel::select('tgl_permintaan', DB::raw('COUNT(*) as jumlah_data'))
        ->where('user_id', Auth::user()->id)
        ->groupBy('tgl_permintaan')
        ->get();
        return view('permintaan-barang.permintaan-brg', [
            'count' => $permintaanCount
        ]);
    }

    public function detail($tgl_permintaan){
        $permintaan = permintaanModel::where('tgl_permintaan',$tgl_permintaan)->where('user_id', Auth::user()->id)->get();
        return view('permintaan-barang.permintaan-brg-detail', [
            'data' => $permintaan,
            'tgl' => $tgl_permintaan
        ]);
    }

    public function create(){
        $barang = barangModel::get();
        $data_permintaan = sementaraModel::all();
        $jumlah_permintaan = sementaraModel::get()->count();
        return view('permintaan-barang.permintaan-brg-add',[
            'data_barang' => $barang,
            'data' => $data_permintaan,
            'jumlah' => $jumlah_permintaan
        ]);
    }

    public function store(Request $request){
        $namaBarang = $request->barang_id;
        $barangSama = sementaraModel::where('barang_id', $namaBarang)->exists();

        $stock_tersedia = $request->stock;
        $jumlah = $request->jumlah;
        $request['barang_id'] = $request->barang_id;
        $request['user_id'] = Auth::user()->id;
        $request['jumlah'] = $jumlah;
        $request['tgl_permintaan'] = Carbon::now();;
        $request['status'] = 1;

        if ($stock_tersedia == 0) {
            Session::flash('status', 'failed');
            Session::flash('pesan', 'Maaf, Stok barang ini habis !!');
            return redirect('/permintaan-barang/add');
        } elseif ($barangSama) {
            Session::flash('status', 'failed');
            Session::flash('pesan', 'Barang dengan nama yang sama sudah ada.');
            return redirect('/permintaan-barang/add');
        } elseif ($jumlah > $stock_tersedia) {
            Session::flash('status', 'failed');
            Session::flash('pesan', 'Maaf, Permintaan Melebihi Persediaan Stok!');
            return redirect('/permintaan-barang/add');
        } else {
            $permintaan = sementaraModel::create($request->all());
            if ($permintaan) {
                Session::flash('status', 'success');
                Session::flash('pesan', 'Tambah Permintaan Barang Sukses!');
                return redirect('permintaan-barang/add');
            }
        }

    }
        
    public function getData($id){
        $barang = barangModel::where('id', $id)->get();
        return response()->json($barang);
    }

    public function delete($id){
        $data_permintaan = sementaraModel::FindOrFail($id);
        $data_permintaan->delete();
        return redirect('permintaan-barang/add');
    }

    public function pesan(){
        $sementara = sementaraModel::get();
        foreach ($sementara as $item) {
            permintaanModel::create($item->toArray()); // Menyimpan data ke tabel tujuan
        }
        sementaraModel::truncate();
        session()->flash('success', 'Data berhasil dipindahkan ke tabel tujuan.');

        return redirect()->back();
    }

    //bagian sapras
    public function indexSapras(){
        $permintaanCount = permintaanModel::select('user_id','tgl_permintaan', DB::raw('COUNT(*) as jumlah_data'))
        ->with('user')
        ->groupBy('user_id', 'tgl_permintaan')
        ->where('status', 1)
        ->get();
        return view('permintaan-sapras.permintaan-brg', [
            'data' => $permintaanCount
        ]);
    }

    public function detailSapras($tgl_permintaan, $id){
        $permintaan = permintaanModel::where('tgl_permintaan', $tgl_permintaan)->where('user_id', $id)->where('status', 1)->get();
        $nama_user = User::FindOrFail($id);
        $nama = $nama_user->name;
        return view('permintaan-sapras.permintaan-brg-detail', [
            'data' => $permintaan,
            'name' => $nama,
            'tgl' => $tgl_permintaan
        ]);
    }

    public function setujuSapras($id){
        $permintaan = permintaanModel::FindOrFail($id);
        $jml_brg_permintaan = $permintaan->jumlah;
        $permintaan->status = 3;
        $permintaan->save();

        $barang = barangModel::FindOrFail($permintaan->barang_id);
        $jml_brg_awal = $barang->stock;
        $sisa_stock = $jml_brg_awal - $jml_brg_permintaan;
        $barang->stock = $sisa_stock;
        $barang->save();

        if($permintaan){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Permintaan berhasil disetujui !!');
            return redirect('/permintaan-barang/sapras/' . $permintaan->tgl_permintaan . '/' . $permintaan->user_id);
        }
    }

    public function tolakSapras($id){
        $permintaan = permintaanModel::FindOrFail($id);
        $permintaan->status = 2;
        $permintaan->save();
        if($permintaan){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Permintaan berhasil ditolak !!');
            return redirect('/permintaan-barang/sapras/' . $permintaan->tgl_permintaan . '/' . $permintaan->user_id);
        }
    }

    public function editSapras($id){
        $permintaan = permintaanModel::with(['user','barangRelasi'])->FindOrFail($id);
        return view('permintaan-sapras.permintaan-brg-edit', [
            'data' => $permintaan
        ]);
    }

    public function updateSapras(Request $request, $id){
        $permintaan = permintaanModel::FindOrFail($id);
        $permintaan->update($request->all());
        if($permintaan){
            Session::flash('status', 'success');
            Session::flash('pesan', 'Edit Permintaan Barang Sukses !!');
        }
        return redirect('/permintaan-barang/sapras/' . $permintaan->tgl_permintaan . '/' . $permintaan->user_id);
    }

    public function tampilCetak(){
        $permintaanCount = permintaanModel::select('tgl_permintaan', DB::raw('COUNT(*) as jumlah_data'))
        ->where('user_id', Auth::user()->id)
        ->where('status', 3)
        ->groupBy('tgl_permintaan')
        ->get();
        return view('permintaan-barang.permintaan-brg-cetak', [
            'count' => $permintaanCount
        ]);
    }

    public function detailCetak($tgl_permintaan, $id){
        if (Auth::user()->rules_id == 1) {
            $permintaan = permintaanModel::where('tgl_permintaan',$tgl_permintaan)->where('user_id', $id)->get();
            $data_permintaan = permintaanModel::with('user')->where('tgl_permintaan', $tgl_permintaan)->where('user_id', $id)->first();
            $nama = $data_permintaan->user->name;

        } else {
            $permintaan = permintaanModel::where('tgl_permintaan',$tgl_permintaan)->where('user_id', Auth::user()->id)->get();
            $data_permintaan = permintaanModel::with('user')->where('tgl_permintaan', $tgl_permintaan)->where('user_id', $id)->first();
            $nama = $data_permintaan->user->name;
        }
        return view('permintaan-barang.permintaan-brg-detailCetak', [
            'data' => $permintaan,
            'tgl' => $tgl_permintaan,
            'name' => $nama

        ]);
    }

    public function tampilPermintaan(){
        $permintaanCount = permintaanModel::select('user_id','tgl_permintaan', DB::raw('COUNT(*) as jumlah_data'))
        ->with('user')
        ->groupBy('user_id', 'tgl_permintaan')
        ->where('status', 3)
        ->get();
        return view('permintaan-sapras.data-brg-keluar', [
            'count' => $permintaanCount
        ]);
    }

    public function deleteBrgKeluar($tgl_permintaan, $id){
        $permintaan = permintaanModel::where('tgl_permintaan', $tgl_permintaan)
        ->where('user_id', $id)
        ->get();
        
        if ($permintaan->isEmpty()) {
            Session::flash('status', 'error');
            Session::flash('pesan', 'Data Barang Keluar tidak ditemukan.');
        } else {
            foreach ($permintaan as $data) {
                $data->delete();
            }

            Session::flash('status', 'success');
            Session::flash('pesan', 'Hapus Barang Keluar sukses !!');
        }

        return redirect('/permintaan-barang-keluar');
    }
}
