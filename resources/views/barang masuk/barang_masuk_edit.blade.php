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
                        <h4>Edit Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        <form action="/barang-masuk/edit-proses/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="basicInput" class="form-label">Nama Barang</label>
                                    <select class="js-example-basic-single form-select" name="barang_id" style="color:rgb(18, 18, 17)">
                                        @foreach ($data_barang as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $data->barang_id ? 'selected' : '' }} title="stock tersisa : {{ $item->stock }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Tanggal Masuk</label>
                                        <input class="form-control" name="tgl_input" value="{{ $data->tgl_input }}" type="date" placeholder="Masukan Tanggal Masuk Barang"
                                            aria-label="default input example">
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Jumlah Barang</label>
                                        <input class="form-control" name="stock" value="{{ $data->stock }}" type="text" placeholder="Masukan Jumlah Barang"
                                            aria-label="default input example">
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <a href="/barang_masuk" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
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