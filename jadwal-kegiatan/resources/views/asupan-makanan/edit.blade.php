<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Makanan - Hidup Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-success">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🍎 Aplikasi Hidup Sehat</span>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">✏ Edit Asupan Makanan</h2>
        <a href="{{ route('asupan-makanan.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar</a>

        <div class="card shadow-sm" style="max-width: 550px;">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Ubah Data Makanan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('asupan-makanan.update', $asupanMakanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Makanan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_makanan" class="form-control" value="{{ $asupanMakanan->nama_makanan }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Porsi <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="porsi" class="form-control" value="{{ $asupanMakanan->porsi }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Satuan <span class="text-danger">*</span></label>
                            <select name="satuan" class="form-select" required>
                                <option value="">-- Pilih Satuan --</option>
                                <option {{ $asupanMakanan->satuan == 'gram' ? 'selected' : '' }}>gram</option>
                                <option {{ $asupanMakanan->satuan == 'piring' ? 'selected' : '' }}>piring</option>
                                <option {{ $asupanMakanan->satuan == 'mangkok' ? 'selected' : '' }}>mangkok</option>
                                <option {{ $asupanMakanan->satuan == 'buah' ? 'selected' : '' }}>buah</option>
                                <option {{ $asupanMakanan->satuan == 'gelas' ? 'selected' : '' }}>gelas</option>
                                <option {{ $asupanMakanan->satuan == 'ml' ? 'selected' : '' }}>ml</option>
                                <option {{ $asupanMakanan->satuan == 'sendok' ? 'selected' : '' }}>sendok</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kalori per Satuan (kkal) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="kalori_per_satuan" class="form-control" value="{{ $asupanMakanan->kalori_per_satuan }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Konsumsi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_konsumsi" class="form-control" value="{{ $asupanMakanan->tanggal_konsumsi }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ $asupanMakanan->catatan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">💾 Update Data</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://
