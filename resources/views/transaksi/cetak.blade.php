<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Faktur Pembayaran</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            width: 70%;
            margin: auto;
        }

        .invoice {
            text-align: center;
        }
        .transaksi {
            text-align: left;
        }

        hr {
            border-top: 1px solid #8c8b8b;
        }

        table {
            width: 100%;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="invoice">
        <h3>{{ config('app.name') }}</h3>
        <p>
            Jl. Raya Padaherang Km.1, Desa Padaherang <br>
            Kec. Padaherang Kab, Pangandaran
        </p>
        <hr>

        <p class="transaksi">
            Kode Transaksi: {{ $penjualan->nomor_transaksi }} <br>
            Tanggal: {{ date('d/m/Y H:i:s', strtotime($penjualan->tanggal)) }} <br>
            Pelanggan:{{ $pelanggan ? $pelanggan->nama : '-' }}<br>
            Kasir: {{ $user->nama }}
        </p>

        <hr>

        <table>
            @foreach ($detailPenjualan as $row)
                <tr>
                    <td>{{ $row->jumlah }} {{ $row->nama_produk }} {{ $row->harga_produk }}</td>
                    <td class="right">{{ number_format($row->subtotal, 0, '', '') }}</td>
                </tr>
            @endforeach
        </table>

        <hr>

        <p class="right">
            Sub Total: {{ number_format($penjualan->subtotal, 0, '', '') }} <br>
            Pajak PPN (10%): {{ number_format($penjualan->pajak, 0, ',', '.') }} <br>
            Diskon: {{ number_format($penjualan->diskon, 0, '', '') }}<br>
            Total: {{ number_format($penjualan->total, 0, ',', '') }} <br>
            Tunai: {{ number_format($penjualan->tunai, 0, ',', '') }} <br>
            Kembalian: {{ number_format($penjualan->kembalian, 0, ',', '') }} <br>
        </p>

        <h3>Terima Kasih</h3>
    </div>
</body>

</html>
