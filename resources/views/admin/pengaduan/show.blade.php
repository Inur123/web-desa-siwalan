@extends('admin.layouts.app')
@section('title', 'Detail Pengaduan')

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
                <form action="{{ route('pengaduan.destroy', $pengaduan->uuid) }}" method="POST"
                    onsubmit="return confirm('Hapus pengaduan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Detail Pengaduan -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
            <div>
                <p class="text-sm text-gray-600">Nama Pelapor</p>
                <p class="text-gray-800 font-medium">{{ $pengaduan->nama }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">No. HP</p>
                <p class="text-gray-800 font-medium">{{ $pengaduan->no_hp }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-600">Alamat</p>
                <p class="text-gray-800 font-medium">{{ $pengaduan->alamat }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tanggal Pengaduan</p>
                <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($pengaduan->tanggal)->translatedFormat('d-m-Y H:i') }}
                </p>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Judul</h2>
            <p class="text-gray-800">{{ $pengaduan->title }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Isi Pengaduan</h2>
            <p class="text-gray-800 whitespace-pre-line">{{ $pengaduan->content }}</p>
        </div>

        @if ($pengaduan->foto)
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Foto</h2>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan"
                    class="w-full max-w-md h-auto object-cover rounded-lg">
            </div>
        @endif

    </div>
@endsection
