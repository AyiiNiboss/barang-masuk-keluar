@extends('layout.main')
@section('content')
<div class="main-content">
    <div class="title text-center">
        Laporan Data Barang
    </div>
<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('searchBarang') }}" method="GET">
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
                    <div class="mb-3">

                    </div>
                    {{-- modal tambah data--}}
                   
                    {{-- <p class="form-text">Across every breakpoint, use <code>.table-responsive</code>  for horizontally scrolling tables.</p>
                    <p class="form-text mb-2">For Different break point use <code>.table-responsive-sm</code> or <code>.table-responsive-md</code> or <code>.table-responsive-lg</code> or <code>.table-responsive-xl</code> or <code>.table-responsive-xxl</code> </p> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Tanggal Input</th>
                                    <th scope="col" class="text-center">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col" class="text-center">Stock</th>
                                    <th scope="col" class="text-center">Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row )
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ Carbon\Carbon::parse($row->tgl_input)->translatedFormat('d F Y');}}</td>
                                    <td class="text-center">{{ $row->kode_barang}}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td class="text-center">{{ $row->stock }}</td>
                                    <td style="padding-left: 40px">@money($row->harga)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (isset($_GET['search']))
                    <form action="{{ route('searchBarang') }}" method="GET">
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