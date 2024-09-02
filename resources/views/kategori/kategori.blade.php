@extends('layout.main')
@section('content')
<div class="main-content">
    <div class="title">
        @if(Session::has('status'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('pesan') }}
          </div>
        @else
        Kategori
        @endif
    </div>
<div class="content-wrapper">
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Kategori </h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                            @if (Auth::user()->rules_id == 1)
                            <div class="header-left">
                                <a href="" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Tambah Data"> <i class="ti-plus"></i> Tambah Data</a>
                            </div>
                            @endif
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
                                    <th scope="col" class="text-center">Nama</th>
                                    @if (Auth::User()->rules_id == 1)
                                        <th scope="col" class="text-center">Action</th>    
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row )
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $row->nama}}</td>
                                   @if (Auth::User()->rules_id == 1)
                                    <td class="text-center">
                                        {{-- <a href="/buku-lihat/{{ $row->id }}" class="btn btn-warning" data-bs-toggle="modal-t" data-bs-target="#largeModal-t" title="Lihat"> <i class="ti-eye"></i></a> --}}
                                        <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $row->id }}" class="btn btn-success"><i class="ti-pencil-alt" title="Edit"></i></a>
                                        <a href="{{ route('kategori-delete', $row->id) }}" class="btn btn-danger"><i class="ti-trash" title="Hapus"></i></a>
                                    </td>   
                                   @endif 
                                </tr>

                                {{-- modal edit start --}}
                                <div class="modal fade" id="staticBackdrop{{ $row->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('kategori-edit',  $row->id ) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="basicInput" class="form-label mb-2">Nama Kategori</label>
                                                    <input class="form-control" name="nama" type="text" value="{{ $row->nama }}" placeholder="Masukan Nama kategori" aria-label="default input example">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="/kategori" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</a>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                {{-- modal edit end --}}

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

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('kategori-add') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="basicInput" class="form-label mb-2">Nama Kategori</label>
                    <input class="form-control" name="nama" type="text" placeholder="Masukan Nama kategori" aria-label="default input example">
                </div>
            </div>
            <div class="modal-footer">
                <a href="/kategori" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
    </div>
</div>

@endsection