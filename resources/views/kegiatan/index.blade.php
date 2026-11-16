@extends('layouts.app')
@section('title', 'Jadwal Kegiatan')

@section('content')
<h1 class="text-xl font-bold mt-4">Selamat Pagi, User</h1>
<p class="text-xs text-gray-500 mb-6">Berikut adalah rangkuman latihan Anda hari ini.</p>

<div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">

        {{-- Durasi latihan --}}
        <div class="rounded-xl border p-5 shadow-sm">
            <p class="text-sm font-semibold">Durasi Latihan</p>
            <p class="text-[10px] text-gray-400">Total waktu latihan hari ini</p>
            <p class="text-3xl font-bold text-green-600 my-3">{{ $durasiHariIni }}</p>
            <div class="grid grid-cols-2 text-xs">
                <div><p class="text-[10px] text-green-600 font-semibold">TOTAL PERSENTASE KEGIATAN</p><p class="font-semibold">{{ $totalAktif }} Aktif</p></div>
                <div><p class="text-[10px] text-green-600 font-semibold">TOTAL JUMLAH KEGIATAN</p><p class="font-semibold">{{ $totalKegiatan }} Kegiatan</p></div>
            </div>
        </div>

        {{-- Form tambah (CREATE) --}}
        <div class="rounded-xl border p-5 shadow-sm">
            <p class="text-sm font-semibold mb-4">Schedule &amp; Details</p>

            @if ($errors->any())
                <div class="mb-3 rounded bg-red-100 text-red-700 text-xs px-3 py-2">
                    <ul class="list-disc ml-4">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('kegiatan.store') }}" method="POST" id="form-kegiatan">
                @csrf
                <div class="grid md:grid-cols-2 gap-4 text-xs">
                    <label class="block">Nama Kegiatan
                        <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" placeholder="Chest Day"
                               class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
                    </label>
                    <label class="block">Tanggal Kegiatan
                        <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', date('Y-m-d')) }}"
                               class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
                    </label>
                    <label class="block">Waktu Mulai
                        <input type="time" name="waktu_mulai" id="mulai" value="{{ old('waktu_mulai') }}"
                               class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
                    </label>
                    <label class="block">Waktu Selesai
                        <input type="time" name="waktu_selesai" id="selesai" value="{{ old('waktu_selesai') }}"
                               class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
                    </label>
                    <div class="md:col-span-2">Total Waktu Kegiatan
                        <div id="total" class="mt-1 rounded bg-gray-100 px-3 py-2 text-gray-500">0 jam/0 menit</div>
                    </div>
                </div>
                <button class="mt-5 w-full rounded-lg bg-green-700 hover:bg-green-800 text-white text-sm py-2.5 font-semibold">
                    Simpan Kegiatan
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        <div class="rounded-xl bg-gray-900 text-white p-6 h-64 flex flex-col justify-end">
            <p class="text-2xl font-bold">Mulailah hari dengan <span class="text-green-400">semangat!</span></p>
        </div>
        <div class="rounded-xl border p-4 text-xs shadow-sm">
            <p class="font-semibold text-green-700 mb-1">TIPS HARI INI</p>
            <p class="text-gray-500">Hindari latihan 6 jam sebelum tidur untuk meningkatkan kualitas Deep Sleep Anda malam ini.</p>
        </div>
    </div>
</div>

{{-- Tabel (READ list) --}}
<div class="rounded-xl bg-green-50 p-5 mt-8">
    <p class="text-sm font-semibold mb-3">Sesi Latihan Terbaru</p>
    <div class="overflow-x-auto bg-white rounded-lg">
        <table class="w-full text-xs">
            <thead class="bg-green-100 text-green-700 text-[10px] uppercase">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Kegiatan</th>
                    <th class="px-4 py-2 text-left">Tanggal Kegiatan</th>
                    <th class="px-4 py-2 text-left">Waktu Kegiatan</th>
                    <th class="px-4 py-2 text-left">Total Waktu Kegiatan</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kegiatans as $k)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $k->nama_kegiatan }}</td>
                        <td class="px-4 py-3">{{ $k->tanggal_kegiatan->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $k->rentang_waktu }}</td>
                        <td class="px-4 py-3">{{ $k->total_waktu }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <a href="{{ route('kegiatan.show', $k) }}" class="text-green-600 font-semibold">Detail</a> |
                            <a href="{{ route('kegiatan.edit', $k) }}" class="text-blue-600 font-semibold">Edit</a> |
                            <form action="{{ route('kegiatan.destroy', $k) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Hapus kegiatan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada kegiatan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $kegiatans->links() }}</div>
</div>

<script>
    // Hitung total waktu secara langsung saat form diisi
    const mulai = document.getElementById('mulai');
    const selesai = document.getElementById('selesai');
    const total = document.getElementById('total');
    function hitung() {
        if (!mulai.value || !selesai.value) return;
        const [h1, m1] = mulai.value.split(':').map(Number);
        const [h2, m2] = selesai.value.split(':').map(Number);
        const diff = (h2 * 60 + m2) - (h1 * 60 + m1);
        total.textContent = diff > 0 ? `${Math.floor(diff / 60)} jam/${diff % 60} menit` : 'Waktu tidak valid';
    }
    mulai.addEventListener('input', hitung);
    selesai.addEventListener('input', hitung);
    hitung();
</script>
@endsection
