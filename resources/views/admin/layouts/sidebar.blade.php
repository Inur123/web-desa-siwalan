<aside id="sidebar"
    class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white p-6 overflow-y-auto md:relative shadow-xl">
    <div class="mb-8 pb-1 border-b border-gray-700">
        <div class="flex items-center gap-3 mb-3">

            <!-- Logo Desa -->
            <div class="w-12 h-12 rounded-lg flex items-center justify-center shadow-lg overflow-hidde">
                <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa Siwalan" class="w-full h-full object-cover">
            </div>

            <div>
                <h1 class="text-xl font-bold text-white">Desa Siwalan</h1>
                <p class="text-gray-400 text-xs">Admin Panel</p>
            </div>
        </div>
    </div>


    <nav class="space-y-1">
        <a href="{{ route('admin.dashboard') }}"
            class="group flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ Request::routeIs('admin.dashboard') ? 'bg-gradient-to-r from-green-600 to-green-500 text-white shadow-lg shadow-green-500/50 scale-105' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
            <i class="fas fa-chart-line w-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('posts.index') }}"
            class="group flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ Request::routeIs('posts.*') ? 'bg-gradient-to-r from-green-600 to-green-500 text-white shadow-lg shadow-green-500/50 scale-105' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
            <i class="fas fa-newspaper w-5"></i>
            <span>Kelola Berita</span>
        </a>

        <a href="{{ route('pengaduan.index') }}"
            class="group flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200
           {{ Request::routeIs('pengaduan.*') && !Request::routeIs('admin.sktm.*') ? 'bg-gradient-to-r from-green-600 to-green-500 text-white shadow-lg shadow-green-500/50 scale-105' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
            <i class="fas fa-envelope w-5"></i>
            <span>Pengaduan</span>
        </a>

        <!-- Dropdown Layanan -->
        <div>
            <button onclick="toggleLayananDropdown()"
                class="group w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200 {{ Request::routeIs('admin.sktm.*') ? 'bg-gray-800/70 text-white' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fas fa-layer-group w-5"></i>
                    <span>Layanan</span>
                </div>
                <i id="layananArrow" class="fas fa-chevron-down transition-transform text-sm"></i>
            </button>
            <div id="layananSubmenu"
                class="{{ Request::routeIs('admin.sktm.*') ? '' : 'hidden' }} ml-4 mt-1 space-y-1 pl-4 border-l-2 border-gray-700">
                <a href="{{ route('admin.sktm.index') }}"
                    class="group flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ Request::routeIs('admin.sktm.*') ? 'bg-green-600 text-white' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white' }}">
                    <i class="fas fa-file-certificate w-4"></i>
                    <span>SKTM</span>
                </a>
            </div>
        </div>

        <div class="my-4 border-t border-gray-700"></div>

        <!-- Dropdown Pengaturan (match Layanan style) -->
        <div>
            <button onclick="toggleSettingDropdown()"
                class="group w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-200 {{ Request::routeIs('admin.settings.*') ? 'bg-gray-800/70 text-white' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <i class="fas fa-cog w-5"></i>
                    <span>Pengaturan</span>
                </div>
                <i id="settingArrow"
                    class="fas fa-chevron-down transition-transform text-sm {{ Request::routeIs('admin.settings.*') ? 'rotate-180' : '' }}"></i>
            </button>
            <div id="settingSubmenu"
                class="{{ Request::routeIs('admin.settings.*') ? '' : 'hidden' }} ml-4 mt-1 space-y-1 pl-4 border-l-2 border-blue-700">
                <a href="{{ route('admin.settings.template-surat.index') }}"
                    class="group flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ Request::routeIs('admin.settings.template-surat.*') ? 'bg-blue-600 text-white' : 'text-blue-400 hover:bg-gray-800/50 hover:text-white' }}">
                    <i class="fas fa-file-alt w-4"></i>
                    <span>Template Surat</span>
                </a>
                <a href="{{ route('admin.settings.fonnte.index') }}"
                    class="group flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ Request::routeIs('admin.settings.fonnte.*') ? 'bg-green-600 text-white' : 'text-green-400 hover:bg-gray-800/50 hover:text-white' }}">
                    <i class="fab fa-whatsapp w-4"></i>
                    <span>WhatsApp</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="mt-auto pt-6 space-y-2">
    </div>
</aside>
