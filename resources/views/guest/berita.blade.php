@extends('guest.layouts.app')
@section('title', 'Berita - Desa Siwalan')

@section('content')
  <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Berita Desa Siwalan</h1>
            <p class="text-lg text-gray-600">Update terbaru dan informasi penting dari Desa Siwalan</p>
        </div>

        <!-- Search & Filter -->
        <div class="mb-12">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Cari berita..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                </div>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                    <option>Semua Kategori</option>
                    <option>Kegiatan Desa</option>
                    <option>Infrastruktur</option>
                    <option>Kesehatan</option>
                    <option>Pendidikan</option>
                    <option>Pengumuman</option>
                </select>
            </div>
        </div>

        <!-- Featured News -->
        <div class="mb-12 bg-white border border-gray-200 rounded-xl overflow-hidden shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <img src="/images/hero-1.png" alt="Berita Utama" class="w-full h-96 object-cover">
                <div class="p-8 flex flex-col justify-center">
                    <span class="text-sm text-green-600 font-semibold mb-2">FEATURED • 19 Desember 2024</span>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Acara Pertemuan Warga Desa Siwalan Sukses Dilaksanakan</h2>
                    <p class="text-gray-700 mb-6">Lebih dari 200 warga menghadiri pertemuan rutin bulanan yang membahas program pembangunan tahun depan, aspirasi masyarakat, dan evaluasi program yang telah berjalan di desa Siwalan.</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- News 1 -->
            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <img src="/placeholder.svg?height=200&width=400" alt="Berita" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm text-green-600 font-semibold">Infrastruktur</span>
                        <span class="text-xs text-gray-600">15 Des 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pembangunan Jalan Desa Fase II Dimulai Bulan Depan</h3>
                    <p class="text-gray-600 text-sm mb-4">Pemerintah desa meresmikan dimulainya fase kedua pembangunan infrastruktur jalan utama yang akan menghubungkan seluruh dusun...</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700 text-sm">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- News 2 -->
            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <img src="/placeholder.svg?height=200&width=400" alt="Berita" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">Kesehatan</span>
                        <span class="text-xs text-gray-600">10 Des 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Program Kesehatan Gratis untuk Semua Warga</h3>
                    <p class="text-gray-600 text-sm mb-4">Desa Siwalan mengadakan pemeriksaan kesehatan rutin dan penyuluhan gaya hidup sehat untuk semua kelompok usia...</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700 text-sm">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- News 3 -->
            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <img src="/placeholder.svg?height=200&width=400" alt="Berita" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-semibold">Pendidikan</span>
                        <span class="text-xs text-gray-600">05 Des 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Program Beasiswa Pendidikan Tahun Ajaran 2025</h3>
                    <p class="text-gray-600 text-sm mb-4">Pemerintah desa membuka program beasiswa untuk siswa berprestasi dan siswa kurang mampu pada tahun ajaran 2025...</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700 text-sm">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- News 4 -->
            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <img src="/placeholder.svg?height=200&width=400" alt="Berita" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Kegiatan</span>
                        <span class="text-xs text-gray-600">01 Des 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Perayaan Hari Lahir Desa Siwalan yang Meriah</h3>
                    <p class="text-gray-600 text-sm mb-4">Seluruh warga desa berkumpul merayakan hari jadi desa Siwalan dengan berbagai acara budaya dan olahraga...</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700 text-sm">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- News 5 -->
            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <img src="/placeholder.svg?height=200&width=400" alt="Berita" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Pembangunan</span>
                        <span class="text-xs text-gray-600">28 Nov 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Program Pemberdayaan UMKM Desa Siwalan</h3>
                    <p class="text-gray-600 text-sm mb-4">Desa Siwalan meluncurkan program khusus untuk memberdayakan usaha kecil menengah dengan pelatihan dan bantuan modal...</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700 text-sm">Baca Selengkapnya →</a>
                </div>
            </article>

            <!-- News 6 -->
            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <img src="/placeholder.svg?height=200&width=400" alt="Berita" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-sm bg-cyan-100 text-cyan-800 px-2 py-1 rounded text-xs font-semibold">Utilitas</span>
                        <span class="text-xs text-gray-600">20 Nov 2024</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Perbaikan Sistem Air Bersih Desa Selesai</h3>
                    <p class="text-gray-600 text-sm mb-4">Proyek perbaikan dan penambahan jaringan air bersih di desa Siwalan telah selesai dilaksanakan dengan baik...</p>
                    <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700 text-sm">Baca Selengkapnya →</a>
                </div>
            </article>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center gap-2">
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Sebelumnya</button>
            <button class="px-4 py-2 bg-green-600 text-white rounded-lg">1</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Selanjutnya</button>
        </div>
    </main>
@endsection
