<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengiriman JPB Express</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
        margin: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
        font-size: 9px;
        table-layout: auto;  /* biar tabel menyesuaikan isi */
    }

    th, td {
        border: 1px solid #000;
        padding: 3px;
        text-align: left;
        word-wrap: break-word;  /* teks panjang bisa dibungkus */
    }

    th { background: #eee; }

    /* Atur lebar kolom */
    .col-no { width: 5%; }
    .col-nama { width: 40%; }   /* nama lebih lebar */
    .col-kategori { width: 25%; }
    .col-harga { width: 20%; }
</style>

</head>
<body>
    <h3>Laporan Pengiriman JPB Express- {{ $pengiriman->tanggal_keberangkatan->format('d-m-Y') }}</h3>

    @foreach($laporan as $area => $data)
        <h4>{{ strtoupper($area) }} - {{ $data['tanggal'] }}</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['items'] as $item)
                    <tr>
                        <td>{{ $item['no'] }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['kategori'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>Rp {{ number_format($data['total'], 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>
