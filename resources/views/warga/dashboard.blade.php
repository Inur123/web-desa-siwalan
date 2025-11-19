 @extends('warga.layouts.app')

 @section('content')
     <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
         <div class="bg-white rounded-lg shadow p-4 md:p-6">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-gray-600 text-sm">Total Berita</p>
                     <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">24</p>
                 </div>
                 <div class="text-3xl md:text-4xl"><i class="fas fa-newspaper text-blue-500"></i></div>
             </div>
         </div>

         <div class="bg-white rounded-lg shadow p-4 md:p-6">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-gray-600 text-sm">Kategori</p>
                     <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">8</p>
                 </div>
                 <div class="text-3xl md:text-4xl"><i class="fas fa-tag text-purple-500"></i></div>
             </div>
         </div>

         <div class="bg-white rounded-lg shadow p-4 md:p-6">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-gray-600 text-sm">Pengajuan Layanan</p>
                     <p class="text-2xl md:text-3xl font-bold text-yellow-600 mt-2">5</p>
                 </div>
                 <div class="text-3xl md:text-4xl"><i class="fas fa-list text-yellow-500"></i></div>
             </div>
         </div>

         <div class="bg-white rounded-lg shadow p-4 md:p-6">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-gray-600 text-sm">Pengaduan Baru</p>
                     <p class="text-2xl md:text-3xl font-bold text-red-600 mt-2">3</p>
                 </div>
                 <div class="text-3xl md:text-4xl"><i class="fas fa-exclamation-triangle text-red-500"></i></div>
             </div>
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
