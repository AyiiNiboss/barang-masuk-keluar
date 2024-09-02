@extends('layout.main')
@section('content')

<div class="main-content">
    <div class="title">
        Dashboard
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            @if (Auth::user()->rules_id != 2)
                <div class="col-md-4">
                    <div class="card">
                        @if (Auth::user()->rules_id == 3)
                            <div class="card-header">
                                <h4>Data Barang</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="text-bold">{{ $data_barang }}</h1>
                            </div>
                            <div class="card-footer">
                                <a href="/laporan-barang" class="text-dark" style="text-decoration: none">info lebih lanjut</a>
                            </div>
                        @endif
                        @if (Auth::user()->rules_id == 1)
                            <div class="card-header">
                                <h4>Data User</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="text-bold">{{ $data_user }}</h1>
                            </div>
                            <div class="card-footer">
                                <a href="/user-active" class="text-dark" style="text-decoration: none">info lebih lanjut</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Barang Masuk</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="text-bold">{{ $data_barang_masuk }}</h1>
                        </div>
                        <div class="card-footer">
                            <a href="/laporan-barang-masuk" class="text-dark" style="text-decoration: none">info lebih lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Barang Keluar</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="text-bold">{{ $data_barang_keluar }}</h1>
                        </div>
                        <div class="card-footer">
                            <a href="/laporan-barang-keluar" class="text-dark" style="text-decoration: none">info lebih lanjut</a>
                        </div>
                    </div>
                </div>
            @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center my-4">
                            <h4>VISI & MISI</h4>
                        </div>
                        <div class="card-body">
                            <h3>Visi</h3>
                            <p>Menggerakkan seluruh koponen masyarakat, bangsa dan negara Indonesia dalam melaksanakan Pencegahan dan Pemberantasan Penyalahgunaan, Peredaran Gelap dan Prekursor Narkotika (P4GN) di wilayah Provinsi Sumatera Selatan.</p>
                            <br>
                            <h3>Misi</h3>
                            <p>Menyatukan dan Menggerakkan seluruh Stake Holder dalam menyukseskan program P4GN di wilayah Provinsi Sumatera Selatan.</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection




