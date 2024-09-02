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
                <div class="card-header my-4 text-center">
                    <h4>Data Permintaan Barang</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="header-left">
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
                                    <th scope="col" class="text-center">Tanggal Permintaan</th>
                                    <th scope="col" class="text-center">Jumlah Permintaan</th>
                                    <th scope="col" class="text-center">Detail</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($count as $row )
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ Carbon\Carbon::parse($row->tgl_permintaan)->translatedFormat('d F Y');}}</td>
                                    <td class="text-center">{{ $row->jumlah_data }}</td>
                                    <td class="text-center">
                                        <a href="/cetak-permintaan/detail/{{ $row->tgl_permintaan }}/{{ Auth::user()->id }}" class="btn btn-info" title="Detail Permintaan">Detail Barang</a>
                                    </td> 
                                    <td class="text-center">
                                        <a href="/permintaan-pdf/{{ $row->tgl_permintaan }}" class="btn btn-danger" target="_blank" title="PDF">PDF</a>
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