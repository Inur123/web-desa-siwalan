@extends('admin.layouts.app')
@section('title', 'Detail Pengaduan - Admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">

    <!-- Header -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pengaduan</h1>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('pengaduan.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
               Kembali
            </a>
            <form action="{{ route('pengaduan.destroy', $pengaduan->uuid) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Detail Pengaduan -->
    <div class="mb-4">
        <p class="text-gray-700"><strong>Pengirim:</strong> {{ $pengaduan->user->name ?? '-' }}</p>
        <p class="text-gray-700"><strong>Email:</strong> {{ $pengaduan->user->email ?? '-' }}</p>
        <p class="text-gray-700"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pengaduan->tanggal)->format('d-m-Y') }}</p>
    </div>

    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Judul</h2>
        <p class="text-gray-800">{{ $pengaduan->title }}</p>
    </div>

    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-2">Isi Pengaduan</h2>
        <p class="text-gray-800 whitespace-pre-line">{{ $pengaduan->content }}</p>
    </div>

    @if($pengaduan->foto)
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Foto</h2>
            <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                 alt="Foto Pengaduan"
                 class="w-full max-w-md h-auto object-cover rounded-lg">
        </div>
    @endif

</div>
@endsection
