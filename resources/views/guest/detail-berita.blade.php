@extends('guest.layouts.app')
@section('title', $post->title)

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Column -->
            <div class="lg:col-span-2">
                <article class="mb-12">
                    <div class="mb-6">
                        <span class="text-sm text-green-600 font-semibold">
                            {{ \Carbon\Carbon::parse($post->tanggal)->translatedFormat('d F Y') }}
                        </span>
                        <h1 class="text-4xl font-bold text-gray-900 mt-2 mb-4">
                            {{ $post->title }}
                        </h1>
                        <span class="text-gray-600">Kategori: <span class="font-semibold">{{ $post->kategori }}</span></span>
                    </div>

                    <!-- Featured Image -->
                    @if ($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                            class="w-full rounded-xl mb-8 shadow-lg" />
                    @endif

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($post->deskripsi)) !!}
                    </div>
                </article>

                <!-- Share Section -->
                <div class="bg-gray-50 rounded-xl p-6 mb-12">
                    <h3 class="font-bold text-gray-900 mb-4">Bagikan Berita Ini</h3>
                    <div class="flex gap-4 flex-wrap">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"
                            class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg transition">Twitter</a>
                        <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">WhatsApp</a>
                        <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Salin
                            Link</button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6">
                <!-- Recent Posts -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h3 class="font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">Berita Terbaru</h3>
                    <div class="space-y-4">
                        @foreach (\App\Models\Post::latest()->take(5)->get() as $recent)
                            <a href="{{ route('berita.show', $recent->slug) }}"
                                class="flex gap-3 items-center hover:bg-gray-50 p-2 rounded-lg transition">
                                @if ($recent->thumbnail)
                                    <img src="{{ asset('storage/' . $recent->thumbnail) }}" alt="Thumbnail"
                                        class="w-16 h-16 rounded-lg object-cover flex-shrink-0" />
                                @endif
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900 line-clamp-2">{{ $recent->title }}</p>
                                    <p class="text-xs text-gray-600 mt-1">
                                        {{ \Carbon\Carbon::parse($recent->tanggal)->translatedFormat('d M') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


                <!-- Categories -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h3 class="font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">Kategori</h3>
                    <div class="space-y-2">
                        @foreach (['Pemerintahan', 'Kesehatan', 'Pendidikan', 'Lingkungan', 'Acara'] as $cat)
                            <a href="{{ route('guest.berita', ['kategori' => $cat]) }}"
                                class="flex items-center justify-between text-sm text-gray-700 hover:text-green-600 py-2">
                                <span>{{ $cat }}</span>
                                <span class="bg-green-100 text-green-800 text-xs rounded-full px-2 py-1">
                                    {{ \App\Models\Post::where('kategori', $cat)->count() }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </main>
@endsection
