<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        /* CSS tambahan untuk tampilan kop surat */
        body {
            background-color: #f8f9fa;
        }
        .header {
            margin-top: 5rem;
            margin-bottom: 2rem;
        }
        .header h2 {
            font-weight: bold;
        }
        .header h5 {
            margin-top: 1rem;
        }
        .header hr {
            border-top: 2px solid #343a40;
        }
        .content-table {
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            border: 2px;
        }
        .content-table td, .content-table th {
            border: none;
            padding: 15px;
        }
        .content-table th {
            background-color: #fbfdff;
            color: #000000;
            font-weight: bold;
            text-align: center;
            font-size: 21px;
        }
        .content-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        td{
            text-align: center;
        }

        p{
        margin-left: 80px;
        }

div.kanan {
width:300px;
float:right;
margin-left:150px;
margin-top: ;
}

div.kiri {
width:350px;
float:left;
margin-left:-25px;
margin-top: 30px;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h2>BADAN NARKOTIKA NASIONAL</h2>
            <h5>PROVINSI SUMATERA SELATAN</h5>
            <h1>LAPORAN PERMINTAAN BARANG</h1>
            <hr>
        </div>
    </div>
        <div class="mt-5 text-center">
            <p>Dengan Rincian Permintaan Barang Sebagai Berikut</p>
        </div>
        <table class="table content-table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Tanggal Permintaan</th>
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">Jumlah Permintaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row )
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td class="text-center">{{ Carbon\Carbon::parse($row->tgl_permintaan)->translatedFormat('d F Y');}}</td>
                    <td class="text-center">{{ $row->user->name}}</td>
                    <td class="text-center">{{ $row->jumlah_data }}</td>
                </tr>
                @endforeach
                
                <!-- Tambahkan baris-baris data sesuai dengan kebutuhan -->
            </tbody>
        </table>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
