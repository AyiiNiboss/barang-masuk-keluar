@extends('layout.main')
@section('content')
<div class="main-content">
    <div class="title">
        @if(Session::has('status'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('pesan') }}
          </div>
        @else
        Barang
        @endif
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Barang</h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="/barang-update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Kode Barang</label>
                                        <input class="form-control" name="kode_barang" value="{{ $data->kode_barang }}" type="text" placeholder="Masukan Kode Barang"
                                            aria-label="default input example">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Tanggal Masuk</label>
                                        <input class="form-control" name="tgl_input" value="{{ $data->tgl_input }}" type="date" placeholder="Masukan Kode Barang"
                                            aria-label="default input example">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Nama Barang</label>
                                        <input class="form-control" name="nama_barang" value="{{ $data->nama_barang }}" type="text" placeholder="Masukan Nama Barang"
                                            aria-label="default input example">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="basicInput" class="form-label">Kategori Barang</label>
                                    <select class="js-example-basic-single form-select" name="kategori_id" style="color:rgb(18, 18, 17)">
                                        @foreach ($dataKategori as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $data->kategori_id ? 'selected' : '' }} title="">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Stock Barang</label>
                                        <input class="form-control" name="stock" value="{{ $data->stock }}" type="text" placeholder="Masukan stock Barang"
                                            aria-label="default input example">
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Harga Satuan Barang</label>
                                        <input class="form-control" name="harga" value="{{ $data->harga }}" type="text" placeholder="Masukan Harga Barang"
                                            aria-label="default input example">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="/barang" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection