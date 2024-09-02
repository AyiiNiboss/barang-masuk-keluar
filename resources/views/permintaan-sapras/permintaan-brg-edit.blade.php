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
                    <div class="card-header">
                        <h4>Edit Data Permintaan Barang</h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="/permintaan-barang/sapras-proses/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Nama</label>
                                        <input class="form-control" name="nama" value="{{ $data->user->name }}" type="text" placeholder="Masukan Kode Barang"
                                            aria-label="default input example" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Nama Barang</label>
                                        <input class="form-control" name="nama_barang" value="{{ $data->barangRelasi->nama_barang }}" type="text" placeholder="Masukan Nama Barang"
                                            aria-label="default input example" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Jumlah Barang</label>
                                        <input class="form-control" name="jumlah" value="{{ $data->jumlah }}" type="text" placeholder="Masukan stock Barang"
                                            aria-label="default input example">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="/permintaan-barang/sapras/{{ $data->tgl_permintaan }}/{{ $data->user_id }}" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
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