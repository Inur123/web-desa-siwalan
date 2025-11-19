@php
    $current = request()->path();
@endphp

<style>
    .mobile-menu {
        position: fixed;
        top: -100%;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: top 0.3s ease;
        z-index: 100;
        overflow-y: auto;
        max-height: 80vh;
    }

    .mobile-menu.active {
        top: 0;
    }

    .menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 99;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .menu-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    body.menu-open {
        overflow: hidden;
    }
</style>

<header class="sticky top-0 z-50 bg-white shadow-md">
    <nav class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/" class="flex items-center gap-2">
            <div
                class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-800 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">D</span>
            </div>
            <span class="font-bold text-xl text-gray-900">Desa Siwalan</span>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex gap-8">
            <a href="/"
                class="font-medium transition {{ request()->is('/') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">Home</a>
            <a href="/profil"
                class="font-medium transition {{ request()->is('profil*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">Profil</a>
            <a href="/layanan"
                class="font-medium transition {{ request()->is('layanan*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">Layanan</a>
            <a href="/pengaduan"
                class="font-medium transition {{ request()->is('pengaduan*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">Pengaduan</a>
            <a href="/berita"
                class="font-medium transition {{ request()->is('berita*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">Berita</a>
        </div>

        {{-- LOGIN / DASHBOARD BUTTON --}}
        @if (Auth::check())
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('warga.dashboard') }}"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-medium hidden md:block">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-medium hidden md:block">
                Login
            </a>
        @endif

        <button class="md:hidden text-gray-700" id="menuBtn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </nav>
</header>

<div class="menu-overlay" id="menuOverlay"></div>

{{-- MOBILE MENU --}}
<div class="mobile-menu" id="mobileMenu">
    <div class="p-6">
        <div class="flex justify-between items-center mb-8">
            <span class="font-bold text-lg text-gray-900">Menu</span>
            <button class="text-gray-700" id="closeMenuBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="space-y-4">
            <a href="/"
                class="block font-medium py-3 border-b border-gray-200 {{ request()->is('/') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                Home
            </a>

            <a href="/profil"
                class="block font-medium py-3 border-b border-gray-200 {{ request()->is('profil*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                Profil
            </a>

            <a href="/layanan"
                class="block font-medium py-3 border-b border-gray-200 {{ request()->is('layanan*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                Layanan
            </a>

            <a href="/pengaduan"
                class="block font-medium py-3 border-b border-gray-200 {{ request()->is('pengaduan*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                Pengaduan
            </a>

            <a href="/berita"
                class="block font-medium py-3 border-b border-gray-200 {{ request()->is('berita*') ? 'text-green-600 font-semibold' : 'text-gray-700 hover:text-green-600' }}">
                Berita
            </a>
            @if (Auth::check())
        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('warga.dashboard') }}"
            class="block w-full text-center bg-green-600 text-white font-semibold rounded-lg py-3 mt-4 hover:bg-green-700 transition">
            Dashboard
        </a>
    @else
        <a href="{{ route('login') }}"
            class="block w-full text-center bg-green-600 text-white font-semibold rounded-lg py-3 mt-4 hover:bg-green-700 transition">
            Login
        </a>
    @endif
        </div>
    </div>
</div>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const closeMenuBtn = document.getElementById('closeMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    const body = document.body;

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.add('active');
        menuOverlay.classList.add('active');
        body.classList.add('menu-open');
    });

    closeMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
        menuOverlay.classList.remove('active');
        body.classList.remove('menu-open');
    });

    menuOverlay.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
        menuOverlay.classList.remove('active');
        body.classList.remove('menu-open');
    });

    document.querySelectorAll('#mobileMenu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            body.classList.remove('menu-open');
        });
    });
</script>
