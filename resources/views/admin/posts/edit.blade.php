@extends('admin.layouts.app')
@section('title', 'Edit Berita - Admin')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-8 w-full">
    <h3 class="text-lg font-bold text-gray-800 mb-6">Edit Berita</h3>
    <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="kategori" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k }}" {{ old('kategori', $post->kategori) == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kategori') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Konten -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
            <textarea name="deskripsi" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 h-32"
                      placeholder="Masukkan konten berita...">{{ old('deskripsi', $post->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                @if($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 object-cover rounded mb-2">
                @endif
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('thumbnail') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal Publikasi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $post->tanggal->format('Y-m-d')) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('tanggal') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-4">
            <a href="{{ route('posts.index') }}"
               class="bg-gray-400 text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-500 transition">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-green-700 transition">
                Update Berita
            </button>
        </div>
    </form>
</div>
@endsection
