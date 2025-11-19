@extends('guest.layouts.app')
@section('title', 'Pengaduan - Desa Siwalan')

@section('content')
 <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Kontak & Pengaduan</h1>
            <p class="text-lg text-gray-600">Hubungi kami dan sampaikan pengaduan atau masukan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Contact Cards -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="text-4xl mb-4">📍</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Alamat</h3>
                <p class="text-gray-700">Jl. Utama Desa Siwalan, Kecamatan Magetan, Provinsi Jawa Timur, 63314</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="text-4xl mb-4">📧</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-700">desa.siwalan@mail.com</p>
                <p class="text-gray-700 text-sm mt-1">Respon: Maksimal 1x24 jam</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="text-4xl mb-4">📞</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon</h3>
                <p class="text-gray-700">(0351) 123-4567</p>
                <p class="text-gray-700 text-sm mt-1">Senin - Jumat: 08:00 - 16:00 WIB</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white border border-gray-200 rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Form Kontak & Pengaduan</h2>

                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Lengkap *</label>
                        <input type="text" placeholder="Masukkan nama lengkap Anda" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Email *</label>
                        <input type="email" placeholder="Masukkan email Anda" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Telepon</label>
                        <input type="tel" placeholder="Masukkan nomor telepon" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Jenis Pesan *</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                            <option>Pilih Jenis Pesan</option>
                            <option>Pengaduan</option>
                            <option>Masukan</option>
                            <option>Pertanyaan</option>
                            <option>Laporan Infrastruktur</option>
                            <option>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Subjek *</label>
                        <input type="text" placeholder="Masukkan subjek pesan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Pesan *</label>
                        <textarea placeholder="Tuliskan pesan, pengaduan, atau masukan Anda..." rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Lampiran (opsional)</label>
                        <input type="file" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                        <p class="text-xs text-gray-600 mt-2">Format: PDF, JPG, PNG (Max 5MB)</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="agree" class="w-4 h-4 rounded border-gray-300">
                        <label for="agree" class="text-sm text-gray-700">Saya setuju dengan kebijakan privasi dan syarat & ketentuan</label>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Map -->
            <div class="bg-white border border-gray-200 rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Lokasi Kantor Desa</h2>
                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center mb-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.7892321580634!2d111.32856!3d-7.62965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79f0e7f7f7f7f7%3A0x0!2sDesa%20Siwalan!5e0!3m2!1sid!2sid!4v1234567890" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Office Hours -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Jam Layanan Kantor</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        <p><strong>Senin - Kamis:</strong> 08:00 - 16:00 WIB</p>
                        <p><strong>Jumat:</strong> 08:00 - 16:30 WIB</p>
                        <p><strong>Sabtu - Minggu & Hari Libur:</strong> Tutup</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
