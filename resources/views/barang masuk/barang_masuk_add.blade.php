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
                    <h4>Tambah Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <form action="/barang-masuk/add-proses" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="basicInput" class="form-label">Nama Barang</label>
                                <select class="js-example-basic-single form-select" id="nama_barang" name="barang_id" style="color:rgb(18, 18, 17)">
                                    <option selected="selected" disabled value="">--Silahkan Pilih--</option>
                                    @foreach ($data_barang as $item)
                                    <option value="{{ $item->id }}" title="stock tersisa : {{ $item->stock }}">{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Harga Satuan</label>
                                    <input class="form-control @error('harga') is-invalid @enderror" id="harga_satuan" name="harga" type="text" placeholder="Masukan harga barang"
                                        aria-label="default input example" readonly>
                                        @error('tgl_input')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Jumlah Barang</label>
                                    <input class="form-control @error('stock') is-invalid @enderror" name="stock" type="text" placeholder="Masukan jumlah barang"
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
                                    <label for="basicInput" class="form-label">Tanggal Masuk</label>
                                    <input class="form-control @error('tgl_input') is-invalid @enderror" name="tgl_input" type="date" placeholder="Masukan tanggal barang masuk"
                                        aria-label="default input example">
                                        @error('tgl_input')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#nama_barang').on('change', function(){
            var kode_barang = $(this).val();
            if (kode_barang) {
                $.ajax({
                    url:'/permintaan-barang/add/' + kode_barang,
                    type: 'GET',
                    data: {
                        '_token' : '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data){
                            $('#stock_tersedia').val(data[0].stock);
                            $('#harga_satuan').val(data[0].harga);
                    }
                })
                
            } 
        });
    });

</script>
@endsection