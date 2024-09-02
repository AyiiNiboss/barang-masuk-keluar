@extends('layout.main')
@section('content')

<div class="main-content">
    <div class="title">
        Pengguna Sistem
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Inactive</h4>
                    </div>
                    <div class="card-body">
                        {{-- <a href="/buku-add" class="btn btn-info btn-sm mb-3" title="Tambah Data"> <i class="ti-plus"></i> Tambah Data</a> --}}
                        {{-- modal tambah data--}}
                        
                        {{-- <p class="form-text">Across every breakpoint, use <code>.table-responsive</code>  for horizontally scrolling tables.</p>
                        <p class="form-text mb-2">For Different break point use <code>.table-responsive-sm</code> or <code>.table-responsive-md</code> or <code>.table-responsive-lg</code> or <code>.table-responsive-xl</code> or <code>.table-responsive-xxl</code> </p> --}}
                        <div class="table-responsive">
                            <table id="example" class="table display">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nama</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_inaktif as $row )
                                        
                                    
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ $row->name}}</td>
                                        <td>{{ $row->email }}</td>
                                        <td class="text-center"><span class="badge bg-danger">
                                            @if ( $row->status  == 'tidak')
                                               Belum Aktif
                                            @endif
                                        </span></td>
                                        <td class="text-center">
                                            <a href="/user-approve/{{ $row->id }}" class="btn btn-success" title="Aktif"><i class="ti-check"></i></a>
                                            <a href="/user-hapus/{{ $row->id }}" class="btn btn-danger" title="Hapus"><i class="ti-trash"></i></a>
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