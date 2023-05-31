<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Barang</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
            margin-top: -15px
        }
       
        .badge-red {
            padding: 5px;
            background-color: red;
            color: white;
            border-radius: 6px;
            font-weight: bold;
        }
        .badge-blue {
            padding: 5px;
            background-color: blue;
            color: white;
            border-radius: 6px;
            font-weight: bold;
        }

        .text-warna {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1 class="text-center">Data Harga</h1>
            <p class="text-center" id="tanggal">
                @php
                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $data = strftime('%A, %d %B %Y');
                @endphp
                Dicetak : <span class="text-warna">{{ $data }}</span>
            </p>
        </header>
        <table class="table table-bordered" style="width: 100%">
            <thead>
                <th>No</th>
                <th>Kode Harga</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Harga Netto</th>
            </thead>
            <tbody>
                @foreach ($harga as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_harga }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->harga_netto, 0, ',', '.') }}</td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
