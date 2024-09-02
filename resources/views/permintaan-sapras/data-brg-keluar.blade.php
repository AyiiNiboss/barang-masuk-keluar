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
    <h4 class="text-center mb-3">Data Permintaan Barang Keluar </h4>
<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mt-4">
                    <form action="{{ route('searchPermintaan') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <input class="form-control" type="date" name="tanggal_awal" placeholder="Tanggal Awal">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="date" name="tanggal_akhir" placeholder="Tanggal Akhir">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" name="search">Cari</button>
                            </div>
                        
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    
                    {{-- modal tambah data--}}
                   
                    {{-- <p class="form-text">Across every breakpoint, use <code>.table-responsive</code>  for horizontally scrolling tables.</p>
                    <p class="form-text mb-2">For Different break point use <code>.table-responsive-sm</code> or <code>.table-responsive-md</code> or <code>.table-responsive-lg</code> or <code>.table-responsive-xl</code> or <code>.table-responsive-xxl</code> </p> --}}
                    
                        {{-- <table id="example2" class="table display"> --}}
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Tanggal Permintaan</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Detail</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($count as $row )
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ Carbon\Carbon::parse($row->tgl_permintaan)->translatedFormat('d F Y');}}</td>
                                    <td class="text-center">{{ $row->user->name }}</td>
                                    <td class="text-center">
                                        <a href="/cetak-permintaan/detail/{{ $row->tgl_permintaan }}/{{ $row->user_id }}" class="btn btn-info" title="Detail Permintaan">Detail Barang</a>
                                    </td> 
                                    <td class="text-center">
                                        <a href="/permintaan-barang-keluar/hapus/{{ $row->tgl_permintaan }}/{{ $row->user_id }}" class="btn btn-danger"><i class="ti-trash" title="Hapus"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (isset($_GET['search']))
                        <form action="{{ route('searchPermintaan') }}" method="GET">
                            <input type="hidden" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                            <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                            <button type="submit" class="btn btn-danger" target="_blank" name="export_pdf">Export PDF</button>
                        </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection