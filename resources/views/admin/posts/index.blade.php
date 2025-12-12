@extends('admin.layouts.app')
@section('title', 'Daftar Berita - Admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header + Tambah Berita -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Berita</h1>
                <p class="text-gray-600">Lihat, edit, atau hapus berita desa</p>
            </div>
            <a href="{{ route('posts.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 shadow-lg shadow-green-500/50 hover:shadow-xl hover:-translate-y-0.5">
                <i class="fas fa-plus"></i>
                <span>Tambah Berita</span>
            </a>
        </div>

        <!-- Posts Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Thumbnail</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
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
           class="inline-flex items-center gap-1 bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
            <i class="fas fa-eye"></i>
            <span>Lihat</span>
        </a>
        <a href="{{ route('posts.edit', $post->slug) }}"
           class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
            <i class="fas fa-edit"></i>
            <span>Edit</span>
        </a>
        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
              onsubmit="return confirm('Hapus berita ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                <i class="fas fa-trash"></i>
                <span>Hapus</span>
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
