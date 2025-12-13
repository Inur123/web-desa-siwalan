 @extends('admin.layouts.app')
 @section('title', 'Dashboard')
 @section('content')
     <div class="mb-8">
         <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard</h1>
         <p class="text-gray-600">Selamat datang di panel admin Desa Siwalan</p>
     </div>

     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Layanan -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Total</span>
            </div>
            <p class="text-sm font-medium opacity-90 mb-1">Total Layanan</p>
            <p class="text-4xl font-bold">{{ $totalLayanan }}</p>
        </div>

        <!-- Total Berita -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
                <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Total</span>
            </div>
            <p class="text-sm font-medium opacity-90 mb-1">Total Berita</p>
            <p class="text-4xl font-bold">{{ $totalPosts }}</p>
        </div>

        <!-- Total Pengaduan -->
        <div class="bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 text-white transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Baru</span>
            </div>
            <p class="text-sm font-medium opacity-90 mb-1">Pengaduan</p>
            <p class="text-4xl font-bold">{{ $totalPengaduan }}</p>
        </div>
    </div>

     <!-- Recent Activity -->
     <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
         <!-- Recent Posts -->
         <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
             <h3 class="text-lg font-bold text-gray-800 mb-4">Berita Terbaru</h3>
             <div class="space-y-4">
                 <div class="border-b pb-4">
                     <h4 class="font-semibold text-gray-800">Program Kesehatan Masyarakat</h4>
                     <p class="text-sm text-gray-600 mt-1">Diterbitkan 23 November 2024</p>
                 </div>
                 <div class="border-b pb-4">
                     <h4 class="font-semibold text-gray-800">Pembangunan Infrastruktur Desa</h4>
                     <p class="text-sm text-gray-600 mt-1">Diterbitkan 20 November 2024</p>
                 </div>
                 <div>
                     <h4 class="font-semibold text-gray-800">Pelatihan Keterampilan Gratis</h4>
                     <p class="text-sm text-gray-600 mt-1">Diterbitkan 15 November 2024</p>
                 </div>
             </div>
             <a href="tambah-berita.html" class="text-green-600 font-semibold mt-4 inline-block hover:text-green-700">Lihat
                 Semua →</a>
         </div>

         <!-- Quick Actions -->
         <div class="bg-white rounded-lg shadow p-6">
             <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
             <div class="space-y-3">
                 <a href="tambah-berita.html"
                     class="block w-full bg-green-600 text-white py-2 px-4 rounded-lg text-center hover:bg-green-700 transition font-medium text-sm">
                     <i class="fas fa-plus"></i> Tambah Berita
                 </a>
                 <a href="tambah-category.html"
                     class="block w-full bg-blue-600 text-white py-2 px-4 rounded-lg text-center hover:bg-blue-700 transition font-medium text-sm">
                     <i class="fas fa-plus"></i> Tambah Kategori
                 </a>
                 <a href="detail-layanan.html"
                     class="block w-full bg-purple-600 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-700 transition font-medium text-sm">
                     <i class="fas fa-list"></i> Lihat Pengajuan
                 </a>
                 <a href="pengaduan-admin.html"
                     class="block w-full bg-red-600 text-white py-2 px-4 rounded-lg text-center hover:bg-red-700 transition font-medium text-sm">
                     <i class="fas fa-exclamation-triangle"></i> Lihat Pengaduan
                 </a>
             </div>
         </div>
     </div>
 @endsection
