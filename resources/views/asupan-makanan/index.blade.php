<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asupan Makanan - Hidup Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-success">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🍎 Aplikasi Hidup Sehat — Pantau Asupan Kalori</span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📋 Daftar Asupan Makanan</h2>
            <a href="{{ route('asupan-makanan.create') }}" class="btn btn-success">➕ Tambah Makanan Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($asupan->isEmpty())
            <div class="alert alert-info text-center py-5">
                <h4>Belum ada data asupan makanan</h4>
                <p>Klik tombol "Tambah Makanan Baru" untuk memulai!</p>
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Makanan</th>
                                <th>Porsi</th>
                                <th>Kalori/Satuan</th>
                                <th>Total Kalori</th>
                                <th>Tanggal</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asupan as $index => $item)
                            <tr>
                                <td><strong>{{ $index + 1 }}</strong></td>
                                <td>{{ $item->nama_makanan }}</td>
                                <td>{{ $item->porsi }} {{ $item->satuan }}</td>
                                <td>{{ $item->kalori_per_satuan }} kkal</td>
                                <td><span class="badge bg-success fs-6">{{ $item->total_kalori }} kkal</span></td>
                                <td>{{ date('d/m/Y', strtotime($item->tanggal_konsumsi)) }}</td>
                                <td>
                                    <a href="{{ route('asupan-makanan.show', $item->id) }}" class="btn btn-sm btn-info">👁 Detail</a>
                                    <a href="{{ route('asupan-makanan.edit', $item->id) }}" class="btn btn-sm btn-warning">✏ Edit</a>
                                    <form action="{{ route('asupan-makanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑 Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <footer class="bg-light text-center py-3 mt-5 border-top">
        <p class="mb-0 text-muted">© 2026 Hidup Sehat — PABW</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
