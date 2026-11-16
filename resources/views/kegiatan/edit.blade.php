@extends('layouts.app')
@section('title', 'Edit Kegiatan')

@section('content')
<h1 class="text-xl font-bold mt-4 mb-6">Edit Kegiatan</h1>

<div class="max-w-xl rounded-xl border p-5 shadow-sm">
    @if ($errors->any())
        <div class="mb-3 rounded bg-red-100 text-red-700 text-xs px-3 py-2">
            <ul class="list-disc ml-4">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('kegiatan.update', $kegiatan) }}" method="POST" class="space-y-4 text-xs">
        @csrf @method('PUT')
        <label class="block">Nama Kegiatan
            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}"
                   class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
        </label>
        <label class="block">Tanggal Kegiatan
            <input type="date" name="tanggal_kegiatan"
                   value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan->format('Y-m-d')) }}"
                   class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
        </label>
        <div class="grid grid-cols-2 gap-4">
            <label class="block">Waktu Mulai
                <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai', substr($kegiatan->waktu_mulai, 0, 5)) }}"
                       class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
            </label>
            <label class="block">Waktu Selesai
                <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', substr($kegiatan->waktu_selesai, 0, 5)) }}"
                       class="mt-1 w-full rounded bg-gray-100 px-3 py-2">
            </label>
        </div>
        <div class="flex gap-3">
            <button class="rounded-lg bg-green-700 hover:bg-green-800 text-white px-5 py-2 font-semibold">Perbarui</button>
            <a href="{{ route('kegiatan.index') }}" class="rounded-lg border px-5 py-2">Batal</a>
        </div>
    </form>
</div>
@endsection
