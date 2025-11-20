@extends('admin.layouts.app')
@section('title', 'Daftar Berita - Admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header + Tambah Berita -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold">Daftar Berita Desa</h1>
                <p class="text-gray-600 text-sm">Lihat, edit, atau hapus berita desa yang telah dibuat</p>
            </div>
            <a href="{{ route('posts.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                Tambah Berita
            </a>
        </div>

        <!-- Posts Table -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Judul</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Kategori</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Thumbnail</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($posts as $index => $post)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $posts->firstItem() + $index }}</td>

                            <!-- Batasi judul -->
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                {{ \Illuminate\Support\Str::limit($post->title, 50) }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">{{ $post->kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($post->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">
                                @if ($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail"
                                        class="w-16 h-16 object-cover rounded">
                                @else
                                    -
                                @endif
                            </td>

                            <!-- Aksi jadi tombol -->
                            <td class="px-6 py-4">
    <div class="flex justify-center items-center gap-2">
        <a href="{{ route('posts.show', $post->slug) }}"
           class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 transition text-sm">
            Lihat
        </a>
        <a href="{{ route('posts.edit', $post->slug) }}"
           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
            Edit
        </a>
        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
              onsubmit="return confirm('Hapus berita ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
                Hapus
            </button>
        </form>
    </div>
</td>



                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada berita</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>
@endsection
