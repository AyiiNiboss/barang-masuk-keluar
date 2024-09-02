@extends('layout.main')
@section('content')
<div class="main-content">
    <div class="title">
        @if(Session::has('status'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('pesan') }}
          </div>
        @else
        Barang Masuk
        @endif
    </div>
<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="header-left">
                            <a href="{{ route('brg-masuk-add') }}" class="btn btn-success btn-sm" title="Tambah Data"> <i class="ti-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    {{-- modal tambah data--}}
                   
                    {{-- <p class="form-text">Across every breakpoint, use <code>.table-responsive</code>  for horizontally scrolling tables.</p>
                    <p class="form-text mb-2">For Different break point use <code>.table-responsive-sm</code> or <code>.table-responsive-md</code> or <code>.table-responsive-lg</code> or <code>.table-responsive-xl</code> or <code>.table-responsive-xxl</code> </p> --}}
                    <div class="table-responsive">
                        {{-- <table id="example2" class="table display"> --}}
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Tanggal Masuk</th>
                                    <th scope="col" class="text-center">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col" class="text-center">Stock</th>
                                    <th scope="col" class="text-center">Harga Satuan</th>
                                    <th scope="col" class="text-center">Total Harga</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row )
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ Carbon\Carbon::parse($row->tgl_input)->translatedFormat('d F Y'); }}</td>
                                    <td class="text-center">{{ $row->barangRelasi->kode_barang}}</td>
                                    <td>{{ $row->barangrelasi->nama_barang }}</td>
                                    <td class="text-center">{{ $row->stock }}</td>
                                    <td>@money($row->barangRelasi->harga)</td>
                                    <td>@money($row->stock * $row->barangRelasi->harga)</td>
                                    <td class="text-center">
                                        {{-- <a href="/buku-lihat/{{ $row->id }}" class="btn btn-warning" data-bs-toggle="modal-t" data-bs-target="#largeModal-t" title="Lihat"> <i class="ti-eye"></i></a> --}}
                                        <a href="/barang-masuk/edit/{{ $row->id }}" class="btn btn-success"><i class="ti-pencil-alt" title="Edit"></i></a>
                                        <a href="/barang-masuk/hapus/{{ $row->id }}" class="btn btn-danger"><i class="ti-trash" title="Hapus"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection