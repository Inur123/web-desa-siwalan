@extends('guest.layouts.app')
@section('title', 'Layanan - Desa Siwalan')

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Layanan Desa Siwalan</h1>
            <p class="text-lg text-gray-600">Layanan terpadu untuk kemudahan warga dalam mengakses administrasi desa</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1: Pengajuan Surat -->
            <a href="detail-layanan.html?id=1" class="service-card bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-lg">
                <div class="text-5xl mb-4 text-blue-600"><i class="fas fa-file-alt"></i></div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Pengajuan Surat</h3>
                <p class="text-gray-600 mb-6">Ajukan surat keterangan, izin, dan dokumen resmi desa secara online dengan proses yang cepat dan mudah.</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>• Surat Keterangan Domisili</p>
                    <p>• Surat Izin Usaha</p>
                    <p>• Surat Keterangan Lainnya</p>
                </div>
                <div class="mt-6 text-green-600 font-semibold hover:text-green-700">
                    Buka Layanan →
                </div>
            </a>

            <!-- Service 2: SKTM & Administrasi -->
            <a href="{{ route('guest.sktm') }}" class="service-card bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-lg">
                <div class="text-5xl mb-4 text-purple-600"><i class="fas fa-id-card"></i></div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">SKTM & Administrasi</h3>
                <p class="text-gray-600 mb-6">Proses cepat untuk surat keterangan tak mampu dan berbagai layanan administrasi kependudukan lainnya.</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>• Surat Keterangan Tidak Mampu</p>
                    <p>• Perubahan Data Penduduk</p>
                    <p>• Administrasi Kependudukan</p>
                </div>
                <div class="mt-6 text-green-600 font-semibold hover:text-green-700">
                    Buka Layanan →
                </div>
            </a>

            <!-- Service 3: Pengaduan & Masukan -->
            <a href="pengaduan.html" class="service-card bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-lg">
                <div class="text-5xl mb-4 text-yellow-600"><i class="fas fa-comments"></i></div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Pengaduan & Masukan</h3>
                <p class="text-gray-600 mb-6">Sampaikan keluhan atau saran untuk perbaikan pelayanan desa dengan mudah dan cepat.</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>• Keluhan Layanan</p>
                    <p>• Saran & Aspirasi</p>
                    <p>• Laporan Infrastruktur</p>
                </div>
                <div class="mt-6 text-green-600 font-semibold hover:text-green-700">
                    Buka Layanan →
                </div>
            </a>

            <!-- Service 4: Izin Pembangunan -->
            <a href="detail-layanan.html?id=3" class="service-card bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-lg">
                <div class="text-5xl mb-4 text-orange-600"><i class="fas fa-building"></i></div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Izin Pembangunan</h3>
                <p class="text-gray-600 mb-6">Permohonan dan penerbitan izin pembangunan rumah, toko, dan bangunan lainnya di wilayah desa.</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>• Izin Pembangunan Rumah</p>
                    <p>• Izin Pembangunan Komersial</p>
                    <p>• Pemeriksaan Lapangan</p>
                </div>
                <div class="mt-6 text-green-600 font-semibold hover:text-green-700">
                    Buka Layanan →
                </div>
            </a>

            <!-- Service 5: Program Kesehatan -->
            <a href="detail-layanan.html?id=4" class="service-card bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-lg">
                <div class="text-5xl mb-4 text-red-600"><i class="fas fa-heartbeat"></i></div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Program Kesehatan</h3>
                <p class="text-gray-600 mb-6">Akses program kesehatan gratis, pemeriksaan rutin, dan penyuluhan gaya hidup sehat untuk warga.</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>• Pemeriksaan Kesehatan Gratis</p>
                    <p>• Program Vaksinasi</p>
                    <p>• Konsultasi Kesehatan</p>
                </div>
                <div class="mt-6 text-green-600 font-semibold hover:text-green-700">
                    Buka Layanan →
                </div>
            </a>

            <!-- Service 6: Program Pendidikan -->
            <a href="detail-layanan.html?id=5" class="service-card bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-lg">
                <div class="text-5xl mb-4 text-green-600"><i class="fas fa-graduation-cap"></i></div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Program Pendidikan</h3>
                <p class="text-gray-600 mb-6">Program beasiswa, pelatihan keterampilan, dan bantuan pendidikan untuk masyarakat desa.</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p>• Beasiswa Pendidikan</p>
                    <p>• Pelatihan Keterampilan</p>
                    <p>• Program Literasi</p>
                </div>
                <div class="mt-6 text-green-600 font-semibold hover:text-green-700">
                    Buka Layanan →
                </div>
            </a>
        </div>
    </main>
@endsection
