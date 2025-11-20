@extends('guest.layouts.app')
@section('title', 'Berita - Desa Siwalan')

@section('content')
<main class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Berita Desa Siwalan</h1>
        <p class="text-lg text-gray-600">Update terbaru dan informasi penting dari Desa Siwalan</p>
    </div>
    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @forelse($posts as $post)
            <a href="{{ route('berita.show', $post) }}" class="block group">
                <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm transform transition-transform duration-200 group-hover:scale-105">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <img src="/placeholder.svg?height=200&width=400" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">{{ $post->kategori }}</span>
                            <span class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($post->tanggal)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($post->deskripsi), 100, '...') }}</p>
                    </div>
                </article>
            </a>
        @empty
            <p class="text-center text-gray-500 col-span-3">Belum ada berita</p>
        @endforelse
    </div>

    <!-- Pagination Laravel -->
    <div class="flex justify-center gap-2 mt-8">
    {{-- Tombol Previous --}}
    @if ($posts->onFirstPage())
        <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Sebelumnya</span>
    @else
        <a href="{{ $posts->previousPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Sebelumnya</a>
    @endif

    {{-- Nomor Halaman --}}
    @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
        @if ($page == $posts->currentPage())
            <span class="px-4 py-2 bg-green-600 text-white rounded-lg">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Tombol Next --}}
    @if ($posts->hasMorePages())
        <a href="{{ $posts->nextPageUrl() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Selanjutnya</a>
    @else
        <span class="px-4 py-2 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Selanjutnya</span>
    @endif
</div>

</main>
@endsection
