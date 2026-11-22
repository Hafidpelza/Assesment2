<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Makanan - Hidup Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-success">
        <div class="container">
            <a href="{{ route('asupan-makanan.index') }}" class="navbar-brand">🍎 Hidup Sehat</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>👁 Detail Asupan Makanan</h2>
        <a href="{{ route('asupan-makanan.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

        <div class="card" style="max-width: 450px;">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nama Makanan</th>
                        <td>{{ $asupanMakanan->nama_makanan }}</td>
                    </tr>
                    <tr>
                        <th>Porsi</th>
                        <td>{{ $asupanMakanan->porsi }} {{ $asupanMakanan->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Kalori/Satuan</th>
                        <td>{{ $asupanMakanan->kalori_per_satuan }} kkal</td>
                    </tr>
                    <tr class="table-success">
                        <th>Total Kalori</th>
                        <td><strong>{{ $asupanMakanan->total_kalori }} kkal</strong></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ date('d F Y', strtotime($asupanMakanan->tanggal_konsumsi)) }}</td>
                    </tr>
                    @if($asupanMakanan->catatan)
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $asupanMakanan->catatan }}</td>
                    </tr>
                    @endif
                </table>
                <a href="{{ route('asupan-makanan.edit', $asupanMakanan->id) }}" class="btn btn-warning">✏ Edit</a>
            </div>
        </div>
    </div>
</body>
</html>
