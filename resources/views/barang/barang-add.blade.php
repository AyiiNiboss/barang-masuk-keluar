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
                    <h4>Tambah Data Barang</h4>
                </div>
                <div class="card-body">
                    <form action="barang-add" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Kode Barang</label>
                                    <input class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" type="text" placeholder="Masukan Kode Barang"
                                        aria-label="default input example">
                                        @error('kode_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Tanggal Masuk</label>
                                    <input class="form-control @error('tgl_input') is-invalid @enderror" name="tgl_input" type="date" placeholder="Masukan Kode Barang"
                                        aria-label="default input example">
                                        @error('tgl_input')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama Barang</label>
                                    <input class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" type="text" placeholder="Masukan Nama Barang"
                                        aria-label="default input example">
                                        @error('nama_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="basicInput" class="form-label">Kategori</label>
                                <select class="js-example-basic-single form-select" id="nama_barang" name="kategori_id" style="color:rgb(18, 18, 17)">
                                    <option selected="selected" disabled value="">--Silahkan Pilih--</option>
                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}" title="">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Stock</label>
                                    <input class="form-control @error('stock') is-invalid @enderror" name="stock" type="text" placeholder="Masukan Stock Barang"
                                        aria-label="default input example">
                                        @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Harga Persatuan</label>
                                    <input class="form-control @error('stock') is-invalid @enderror" name="harga" type="text" placeholder="Masukan Harga Barang"
                                        aria-label="default input example">
                                        @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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