@extends('layouts.app')
@section('title', 'Detail Kegiatan')

@section('content')
<h1 class="text-xl font-bold mt-4 mb-6">Detail Kegiatan</h1>

<div class="max-w-xl rounded-xl border p-5 shadow-sm text-sm">
    <dl class="grid grid-cols-3 gap-y-3">
        <dt class="text-gray-500">Nama Kegiatan</dt><dd class="col-span-2 font-semibold">{{ $kegiatan->nama_kegiatan }}</dd>
        <dt class="text-gray-500">Tanggal</dt><dd class="col-span-2">{{ $kegiatan->tanggal_kegiatan->format('d/m/Y') }}</dd>
        <dt class="text-gray-500">Waktu</dt><dd class="col-span-2">{{ $kegiatan->rentang_waktu }}</dd>
        <dt class="text-gray-500">Total Waktu</dt><dd class="col-span-2">{{ $kegiatan->total_waktu }}</dd>
    </dl>
    <div class="mt-6 flex gap-3 text-xs">
        <a href="{{ route('kegiatan.edit', $kegiatan) }}" class="rounded-lg bg-blue-600 text-white px-4 py-2">Edit</a>
        <a href="{{ route('kegiatan.index') }}" class="rounded-lg border px-4 py-2">Kembali</a>
    </div>
</div>
@endsection
