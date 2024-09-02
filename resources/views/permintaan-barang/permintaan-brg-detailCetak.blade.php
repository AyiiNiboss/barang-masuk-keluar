@extends('layout.main')
@section('content')
<div class="main-content">
    <div class="title">
        @if(Session::has('status'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('pesan') }}
          </div>
        @endif
    </div>
<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-5 mt-2">
                    @if (Auth::user()->rules_id == 1)
                        <h4 class="text-center text-capitalize">Data Pengeluaran Barang {{ $name }} </h4>
                    @else
                        <h4 class="text-center">Data Permintaan Barang Tanggal {{ Carbon\Carbon::parse($tgl)->translatedFormat('d F Y'); }} </h4>
                    @endif
                    
                </div>
                <div class="card-body">
                    {{-- modal tambah data--}}
                   
                    {{-- <p class="form-text">Across every breakpoint, use <code>.table-responsive</code>  for horizontally scrolling tables.</p>
                    <p class="form-text mb-2">For Different break point use <code>.table-responsive-sm</code> or <code>.table-responsive-md</code> or <code>.table-responsive-lg</code> or <code>.table-responsive-xl</code> or <code>.table-responsive-xxl</code> </p> --}}
                    <div class="table-responsive">
                        {{-- <table id="example2" class="table display"> --}}
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Kode Barang</th>
                                    <th scope="col" class="text-center">Nama Barang</th>
                                    <th scope="col" class="text-center">Jumlah</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row )
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $row->barangRelasi->kode_barang }}</td>
                                    <td class="text-center">{{ $row->barangRelasi->nama_barang }}</td>
                                    <td class="text-center">{{ $row->jumlah }}</td>
                                    <td class="text-center">
                                        @if ($row->status == 1)
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @elseif($row->status == 2)
                                            <span class="badge bg-danger">Tidak Disetujui</span>
                                        @else
                                            <span class="badge bg-success">Telah Disetujui</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (Auth::user()->rules_id == 1)
                            <a href="/permintaan-barang-keluar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</a>
                        @else
                            <a href="/cetak-permintaan" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection