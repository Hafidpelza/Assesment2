<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Makanan - Hidup Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-success">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🍎 Aplikasi Hidup Sehat</span>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">➕ Tambah Asupan Makanan</h2>
        <a href="{{ route('asupan-makanan.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar</a>

        <div class="card shadow-sm" style="max-width: 550px;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Form Input Makanan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('asupan-makanan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Makanan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_makanan" class="form-control" placeholder="Contoh: Nasi Putih" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Porsi <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="porsi" class="form-control" placeholder="Contoh: 1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Satuan <span class="text-danger">*</span></label>
                            <select name="satuan" class="form-select" required>
                                <option value="">-- Pilih Satuan --</option>
                                <option>gram</option>
                                <option>piring</option>
                                <option>mangkok</option>
                                <option>buah</option>
                                <option>gelas</option>
                                <option>ml</option>
                                <option>sendok</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kalori per Satuan (kkal) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="kalori_per_satuan" class="form-control" placeholder="Contoh: 130" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Konsumsi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_konsumsi" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika perlu..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">💾 Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
