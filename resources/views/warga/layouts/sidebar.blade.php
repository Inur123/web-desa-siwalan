<div id="sidebarOverlay"
     class="hidden fixed inset-0 bg-white/10 backdrop-blur-sm z-10 md:hidden"
     onclick="toggleSidebar()"></div>

<aside id="sidebar" class="w-64 bg-gray-900 text-white p-6 overflow-y-auto md:relative">
    <div class="mb-10">
        <div class="text-3xl mb-2"><i class="fas fa-house text-green-500"></i></div>
        <h1 class="text-xl font-bold">Desa Siwalan</h1>
        <p class="text-gray-400 text-sm">Admin Panel</p>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('warga.dashboard') }}"
           class="block px-4 py-3 rounded-lg font-medium transition
           {{ request()->routeIs('warga.dashboard') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="{{ route('warga.pengaduan') }}"
           class="block px-4 py-3 rounded-lg font-medium transition
           {{ request()->routeIs('warga.pengaduan') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <i class="fas fa-exclamation-triangle"></i> Pengaduan
        </a>
    </nav>

    <div class="mt-auto pt-6 space-y-2">
    </div>
</aside>

