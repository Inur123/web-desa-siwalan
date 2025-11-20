<aside id="sidebar" class="w-64 bg-gray-900 text-white p-6 overflow-y-auto md:relative">
    <div class="mb-10">
        <div class="text-3xl mb-2"><i class="fas fa-house text-green-500"></i></div>
        <h1 class="text-xl font-bold">Desa Siwalan</h1>
        <p class="text-gray-400 text-sm">Admin Panel</p>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-3 rounded-lg font-medium transition
           {{ Request::routeIs('admin.dashboard') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="{{ route('posts.index') }}"
           class="block px-4 py-3 rounded-lg font-medium transition
           {{ Request::routeIs('posts.*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <i class="fas fa-newspaper"></i> Kelola Berita
        </a>

        <a href="{{ route('pengaduan.index') }}"
           class="block px-4 py-3 rounded-lg font-medium transition
           {{ Request::routeIs('pengaduan.*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <i class="fas fa-envelope"></i> Pengaduan
        </a>
    </nav>

    <div class="mt-auto pt-6 space-y-2">
    </div>
</aside>
