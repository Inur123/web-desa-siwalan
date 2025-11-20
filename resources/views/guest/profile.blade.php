@extends('guest.layouts.app')
@section('title', 'Profile - Desa Siwalan')

@section('content')
 <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Profil Desa Siwalan</h1>
            <p class="text-lg text-gray-600">Informasi lengkap tentang Desa Siwalan</p>
        </div>

        <!-- Village Image -->
        <div class="mb-12 rounded-xl overflow-hidden shadow-lg">
            <img src="/placeholder.svg?height=400&width=1200" alt="Kantor Desa" class="w-full h-96 object-cover">
        </div>

        <!-- Profile Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2">
                <!-- Vision & Mission -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Visi dan Misi</h2>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-green-600 mb-3">Visi</h3>
                        <p class="text-gray-700 leading-relaxed">Mewujudkan Desa Siwalan yang maju, modern, berkelanjutan, dan sejahtera dengan meningkatkan kualitas hidup seluruh warganya melalui pembangunan yang inklusif dan berkelanjutan.</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-green-600 mb-3">Misi</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li>• Meningkatkan kualitas pendidikan dan kesehatan masyarakat</li>
                            <li>• Mengembangkan infrastruktur desa yang modern dan berkelanjutan</li>
                            <li>• Memberdayakan ekonomi lokal dan usaha kecil menengah</li>
                            <li>• Meningkatkan partisipasi aktif warga dalam pembangunan desa</li>
                            <li>• Menjaga kelestarian lingkungan dan budaya lokal</li>
                        </ul>
                    </div>
                </div>

                <!-- History Section -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Sejarah Desa</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Desa Siwalan merupakan desa yang terletak di Kecamatan Magetan, Provinsi Jawa Timur dengan sejarah panjang yang kaya akan tradisi dan budaya lokal. Desa ini berkembang dari pemukiman pertanian tradisional menjadi desa modern yang mengintegrasikan nilai-nilai tradisional dengan perkembangan teknologi kontemporer.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Dengan jumlah penduduk lebih dari 4.000 jiwa, Desa Siwalan terus berinovasi dalam memberikan pelayanan terbaik kepada warganya sambil mempertahankan identitas budaya dan kearifan lokal yang telah diwariskan turun temurun.
                    </p>
                </div>

                <!-- Government Structure -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Struktur Pemerintahan</h2>

                    <div class="space-y-4">
                        <div class="border-l-4 border-green-600 pl-4">
                            <h4 class="font-semibold text-gray-900">Kepala Desa</h4>
                            <p class="text-gray-700">H. Supardi, S.E.</p>
                        </div>
                        <div class="border-l-4 border-green-600 pl-4">
                            <h4 class="font-semibold text-gray-900">Sekretaris Desa</h4>
                            <p class="text-gray-700">Budi Santoso, S.Pd.</p>
                        </div>
                        <div class="border-l-4 border-green-600 pl-4">
                            <h4 class="font-semibold text-gray-900">Bendahara Desa</h4>
                            <p class="text-gray-700">Siti Nurhaliza, A.Md.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Quick Facts -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Fakta Singkat</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-600 font-semibold">Penduduk</p>
                            <p class="text-gray-900 font-bold">4.250 orang</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Kepala Keluarga</p>
                            <p class="text-gray-900 font-bold">850 KK</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Dusun</p>
                            <p class="text-gray-900 font-bold">15 Dusun</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Luas Wilayah</p>
                            <p class="text-gray-900 font-bold">25 km²</p>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kontak Kantor</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-600 font-semibold">Alamat</p>
                            <p class="text-gray-700">Jl. Utama Desa Siwalan, Magetan, Jawa Timur</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Email</p>
                            <p class="text-gray-700">desa.siwalan@mail.com</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Telepon</p>
                            <p class="text-gray-700">(0351) 123-4567</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Jam Layanan</p>
                            <p class="text-gray-700">Senin - Jumat: 08:00 - 16:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Map -->
        <div class="bg-white border border-gray-200 rounded-xl p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Lokasi Desa Siwalan</h2>
            <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.6592346924326!2d111.51846657500646!3d-7.930613692093172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790af78ef4e9df%3A0xe95d424787bbe28!2sBalai%20Desa%20Siwalan!5e0!3m2!1sid!2sid!4v1763623006043!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </main>
@endsection
