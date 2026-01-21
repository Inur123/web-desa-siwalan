<footer class="bg-gray-900 text-gray-300 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">

            <!-- Logo dan Slogan -->
            <div>
                <div class="flex items-center mb-4">
                    <img class="h-10 w-10 mr-3" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa" />
                    <h3 class="text-xl font-bold">Desa Siwalan</h3>
                </div>

                <p class="text-gray-300 mb-4">
                    Membangun masa depan desa yang lebih baik bersama seluruh warga masyarakat.
                </p>
            </div>

            <!-- Navigasi -->
            <div>
                <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-green-400 transition">Beranda</a></li>
                    <li><a href="/profil" class="hover:text-green-400 transition">Profil Desa</a></li>
                    <li><a href="/layanan" class="hover:text-green-400 transition">Layanan</a></li>
                    <li><a href="/berita" class="hover:text-green-400 transition">Berita</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="text-white font-semibold mb-4">Kontak</h4>
                <p class="text-sm mb-2"><strong>Alamat:</strong> Jl. Utama Desa Siwalan, ponorogo</p>
                <p class="text-sm mb-2"><strong>Email:</strong> desa.siwalan@mail.com</p>
                <p class="text-sm"><strong>Jam Layanan:</strong> Senin - Jumat, 08:00 - 16:00 WIB</p>
            </div>

            <!-- Media Sosial -->
            <div>
                <h4 class="text-white font-semibold mb-4">Media Sosial</h4>
                <div class="flex gap-4 text-xl">
                    <a href="https://facebook.com/157725697732754" target="_blank" rel="noopener noreferrer"
                        class="hover:text-blue-500 transition" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="https://tiktok.com/@siwalan.desa" target="_blank" rel="noopener noreferrer"
                        class="hover:text-gray-500 transition" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>

                    <a href="https://instagram.com/siwalan.desa" target="_blank" rel="noopener noreferrer"
                        class="hover:text-pink-500 transition" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://www.youtube.com/@pemdessiwalan" target="_blank" rel="noopener noreferrer"
                        class="hover:text-red-500 transition" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>


        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 pt-8 text-center text-sm">
            <p>&copy; {{ now()->year }} Desa Siwalan. Semua hak dilindungi. |
                <a href="#" class="hover:text-green-400">Kebijakan Privasi</a> |
                <a href="#" class="hover:text-green-400">Syarat & Ketentuan</a>
            </p>
        </div>

    </div>
</footer>
