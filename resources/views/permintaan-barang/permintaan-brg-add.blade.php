@extends('layout.main')

@section('content')
<div class="main-content">
    <div class="title text-center">
        @if(Session::has('status'))
        <div class="alert alert-info" role="alert">
            {{ Session::get('pesan') }}
          </div>
        @endif
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Form Permintaan Barang</h4>
                    </div>
                    <div class="card-body">
                        <form action="/permintaan-barang/add-proses" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Nama</label>
                                        <input class="form-control" name="nama" type="text" value="{{ Auth::user()->name }}"
                                            aria-label="default input example" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="basicInput" class="form-label">Nama Barang</label>
                                    <select class="js-example-basic-single form-select" id="nama_barang" name="barang_id" style="color:rgb(10, 10, 10)">
                                        <option selected="selected" disabled value="">--Silahkan Pilih--</option>
                                        @foreach ($data_barang as $item)
                                        <option value="{{ $item->id }}" title="stock tersisa : {{ $item->stock }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Harga Satuan</label>
                                        <input class="form-control" id="harga_satuan" name="harga" type="text"
                                            aria-label="default input example" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Stock Tersedia</label>
                                        <input class="form-control" id="stock_tersedia" name="stock" type="text" 
                                            aria-label="default input example" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="basicInput" class="form-label">Jumlah</label>
                                        <input class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" type="number" placeholder="Masukan Jumlah Barang"
                                            aria-label="default input example" required>
                                            @error('jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="/permintaan-barang" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Data Permintaan Hari ini</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <table id="example2" class="table display"> --}}
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nama Barang</th>
                                        <th scope="col" class="text-center">Jumlah</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row )
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                        <td class="text-center">{{ $row->barangRelasi->nama_barang }}</td>
                                        <td class="text-center">{{ $row->jumlah }}</td>
                                        <td class="text-center">
                                            <a href="/permintaan-barang/hapus/{{ $row->id }}" class="btn btn-danger" title="Hapus"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (!$jumlah == 0)
                                <a href="/permintaan-barang/pesan" class="btn btn-success btn-sm" title="Minta Barang">Minta Barang</a>
                            @endif
                        </div>
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