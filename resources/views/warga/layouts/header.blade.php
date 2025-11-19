@php
    $user = Auth::user();
    $name = $user->name;

    // Buat inisial dari nama
    $parts = explode(' ', $name);

    if (count($parts) === 1) {
        // Jika nama hanya satu kata → ambil 2 huruf pertama
        $initial = strtoupper(substr($parts[0], 0, 2));
    } else {
        // Jika lebih dari 1 kata → ambil huruf pertama kata awal + huruf pertama kata terakhir
        $initial = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
    }
@endphp


<header class="bg-white shadow sticky top-0 z-40">
    <div class="px-4 md:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="md:hidden bg-gray-900 text-white p-2 rounded-lg z-50">
                <i class="fas fa-bars"></i>
            </button>

            <div>
                <h2 class="text-lg md:text-2xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-gray-600 text-xs md:text-sm">
                    Selamat datang kembali, Warga
                </p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <span class="text-gray-600 text-sm hidden sm:inline">{{ $name }}</span>

            <div class="relative">
                <button onclick="toggleDropdown()" class="flex items-center gap-2 p-2 hover:bg-gray-100 rounded-lg">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                        {{ $initial }}
                    </div>
                    <i id="dropdownArrow" class="fas fa-chevron-down text-gray-600"></i>
                </button>

                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition font-medium">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
