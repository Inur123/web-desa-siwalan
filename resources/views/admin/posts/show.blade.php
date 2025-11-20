@extends('admin.layouts.app')
@section('title', 'Detail Berita - Admin')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-6">

    <!-- Header -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Detail Berita</h1>
        <a href="{{ route('posts.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
           Kembali
        </a>
    </div>

    <!-- Kontainer Thumbnail + Konten -->
    <div class="flex flex-col md:flex-row gap-6">

        <!-- Thumbnail kiri -->
        @if($post->thumbnail)
            <div class="md:w-1/2 w-full">
                <img src="{{ asset('storage/' . $post->thumbnail) }}"
                     alt="Thumbnail"
                     class="w-full h-auto object-cover rounded-lg max-h-[500px] md:max-h-[600px]">
            </div>
        @endif

        <!-- Konten kanan -->
        <div class="md:w-1/2 w-full flex flex-col justify-between">
            <!-- Judul -->
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">{{ $post->title }}</h2>

            <!-- Kategori & Tanggal -->
            <div class="flex flex-wrap gap-4 text-gray-600 mb-6">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">{{ $post->kategori }}</span>
                <span>{{ \Carbon\Carbon::parse($post->tanggal)->format('d-m-Y') }}</span>
            </div>

            <!-- Deskripsi -->
            <div class="prose max-w-full text-gray-700 mb-6">
                {!! nl2br(e($post->deskripsi)) !!}
            </div>

            <!-- Tombol aksi -->
            <div class="flex flex-wrap gap-3 justify-start items-center">
                <a href="{{ route('posts.edit', $post->id) }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    Edit
                </a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
