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

                <!-- Menampilkan alert sukses -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Subjek / Judul Pengaduan *</label>
                        <input type="text" name="title" placeholder="Masukkan subjek pesan"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Pesan / Isi Pengaduan *</label>
                        <textarea name="content" placeholder="Tuliskan pesan, pengaduan, atau masukan Anda..." rows="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Lampiran (opsional)</label>
                        <input type="file" name="foto" accept=".jpg,.jpeg,.png"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600">
                        <p class="text-xs text-gray-600 mt-2">Format: JPG, PNG (Max 2MB)</p>
                    </div>


                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="agree" class="w-4 h-4 rounded border-gray-300" required>
                        <label for="agree" class="text-sm text-gray-700">Saya setuju dengan kebijakan privasi dan syarat
                            & ketentuan</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                        Kirim Pengaduan
                    </button>
                </form>
            </div>


            <!-- Map -->
            <div class="bg-white border border-gray-200 rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Lokasi Kantor Desa</h2>
                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center mb-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.6592346924326!2d111.51846657500646!3d-7.930613692093172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790af78ef4e9df%3A0xe95d424787bbe28!2sBalai%20Desa%20Siwalan!5e0!3m2!1sid!2sid!4v1763623006043!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
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
