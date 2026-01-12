
@extends('guest.layouts.app')
@section('title', 'Profile - Desa Siwalan')

@section('content')
<main class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Profil Desa Siwalan</h1>
        <p class="text-lg text-gray-600">Informasi lengkap tentang Desa Siwalan, Kecamatan Mlarak, Kabupaten Ponorogo, Jawa Timur</p>
    </div>

    <!-- Village Image -->
    <div class="mb-12 rounded-xl overflow-hidden shadow-lg">
        <img src="/placeholder.svg?height=400&width=1200" alt="Balai / Kantor Desa Siwalan" class="w-full h-96 object-cover">
    </div>

    <!-- Profile Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2">
            <!-- Identitas Desa -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Identitas Desa</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Desa</p>
                        <p class="text-gray-900 font-bold text-base">Siwalan</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Kecamatan</p>
                        <p class="text-gray-900 font-bold text-base">Mlarak</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Kabupaten</p>
                        <p class="text-gray-900 font-bold text-base">Ponorogo</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Provinsi</p>
                        <p class="text-gray-900 font-bold text-base">Jawa Timur</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Kode Desa / Kelurahan</p>
                        <p class="text-gray-900 font-bold text-base">3502082005</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Luas Wilayah</p>
                        <p class="text-gray-900 font-bold text-base">190,67 Hektar</p>
                        <p class="text-gray-600">≈ 1,9067 km²</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Koordinat Bujur</p>
                        <p class="text-gray-900 font-bold text-base">11.152.950</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Koordinat Lintang</p>
                        <p class="text-gray-900 font-bold text-base">-7.931205</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 md:col-span-2">
                        <p class="text-gray-600 font-semibold">Ketinggian di Atas Permukaan Laut</p>
                        <p class="text-gray-900 font-bold text-base">125 Meter</p>
                    </div>
                </div>

                <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-gray-700">
                        Status wilayah terluar:
                        <span class="font-semibold text-gray-900">Tidak</span> (Indonesia),
                        <span class="font-semibold text-gray-900">Tidak</span> (Provinsi),
                        <span class="font-semibold text-gray-900">Tidak</span> (Kabupaten/Kota),
                        <span class="font-semibold text-gray-900">Tidak</span> (Kecamatan).
                    </p>
                </div>
            </div>

            <!-- Kependudukan -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Kependudukan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Jumlah KK</p>
                        <p class="text-gray-900 font-bold text-2xl">1.035</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Jumlah Penduduk</p>
                        <p class="text-gray-900 font-bold text-2xl">4.223</p>
                        <p class="text-gray-600 text-sm">Laki-laki 2.840 • Perempuan 1.383</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 md:col-span-2">
                        <p class="text-gray-600 font-semibold">Kepadatan Penduduk</p>
                        <p class="text-gray-900 font-bold text-2xl">1.489</p>
                        <p class="text-gray-600 text-sm">Jiwa / km</p>
                    </div>
                </div>
            </div>

            <!-- Struktur Pemerintahan -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Struktur Pemerintahan Desa</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php
                        $pemerintahan = [
                            ['jabatan' => 'Kepala Desa', 'nama' => 'NOVY DWI HERMAWATI, S.Pd, M.MPd'],
                            ['jabatan' => 'Sekretaris Desa', 'nama' => 'FARID ZAENAL MUTTAQIN'],
                            ['jabatan' => 'Kaur Tata Usaha dan Umum', 'nama' => 'KEN SULIH ARDHANARESWARI'],
                            ['jabatan' => 'Kaur Perencanaan', 'nama' => 'AMIN SANTOSA'],
                            ['jabatan' => 'Kaur Keuangan', 'nama' => 'AIMMA ZUHA MUSNIDA, SE. ME.'],
                            ['jabatan' => 'Kasi Pemerintahan', 'nama' => 'Dra. KHASANATUL FADILAH'],
                            ['jabatan' => 'Kasi Kesejahteraan', 'nama' => 'AHMAD FURQON'],
                            ['jabatan' => 'Kasi Pelayanan', 'nama' => "MU'THON JAZULI, S.Pd.I"],
                            ['jabatan' => 'Staff Urusan Keuangan', 'nama' => 'ULFIANA DAIROTURROHMAH, SE.'],
                            ['jabatan' => 'Kamituwo Dkh. I', 'nama' => 'ANGGIS ZAHRUL MAWAD'],
                            ['jabatan' => 'Kamituwo Dkh. II', 'nama' => 'PEBRI MAHARTIKA'],
                            ['jabatan' => 'Kamituwo Dkh. III', 'nama' => 'HARSONO'],
                        ];
                    @endphp

                    @foreach ($pemerintahan as $item)
                        <div class="border-l-4 border-green-600 pl-4 py-1">
                            <h4 class="font-semibold text-gray-900">{{ $item['jabatan'] }}</h4>
                            <p class="text-gray-700">{{ $item['nama'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Potensi Desa -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Potensi Desa</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Kelompok Kesenian</h3>
                        <ul class="text-gray-700 space-y-2 list-disc pl-5">
                            <li>Reog Singo Palang Jiwo</li>
                            <li>Hadroh Attoyyibah</li>
                            <li>Hadroh Arrohmah</li>
                            <li>Hadroh Sabilul Hidayah</li>
                            <li>Hadroh Roudotul Jannah</li>
                            <li>Hadroh Zahrotul Jannah</li>
                            <li>Hadroh La Roiba</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Destinasi / Pariwisata</h3>
                        <ul class="text-gray-700 space-y-2 list-disc pl-5">
                            <li>Taman Belik Umbul</li>
                        </ul>

                        <div class="mt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Ruang Terbuka Hijau</h3>
                            <ul class="text-gray-700 space-y-2 list-disc pl-5">
                                <li>Siwalan Asri</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ekonomi -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Aspek Ekonomi</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Status & Nama BUMDes</p>
                        <p class="text-gray-900 font-bold text-base">Nirwana</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Jumlah Pekerja Migran</p>
                        <p class="text-gray-900 font-bold text-base">-</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 md:col-span-2">
                        <p class="text-gray-600 font-semibold">Jumlah UMKM</p>
                        <p class="text-gray-900 font-bold text-base">-</p>
                        <p class="text-gray-600 text-sm">Belum tercantum pada data profil.</p>
                    </div>
                </div>
            </div>

            <!-- Keamanan & Ketertiban -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Keamanan, Pelayanan & Ketertiban</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">LINMAS</h3>
                        <ul class="text-gray-700 space-y-2 list-disc pl-5">
                            <li>Rohmat</li>
                            <li>Ratno Prihaji</li>
                            <li>Purwosubroto</li>
                            <li>Sujito</li>
                            <li>Sareh</li>
                            <li>Sukarno</li>
                            <li>Ngudiono</li>
                            <li>Sidiq</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Kader (Ringkas)</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li><span class="font-semibold text-gray-900">Posyandu Balita:</span> 15 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader Remaja:</span> 5 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader Posbindu:</span> 5 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader Lansia:</span> 4 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader Taman Posyandu:</span> 4 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader BKB:</span> 6 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader PHBS:</span> 1 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader Jumantik:</span> 2 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader Jiwa:</span> 1 orang</li>
                            <li><span class="font-semibold text-gray-900">Kader TBC:</span> -</li>
                        </ul>
                    </div>
                </div>

                <!-- Detail Kader (opsional tampilkan lengkap) -->
                <details class="mt-6 bg-white border border-gray-200 rounded-lg p-5">
                    <summary class="cursor-pointer font-semibold text-gray-900">Lihat daftar kader lengkap</summary>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Kader Posyandu Balita</h4>
                            <ol class="list-decimal pl-5 text-gray-700 space-y-1">
                                <li>SALBIYATI</li>
                                <li>TUTIK ANDARWATI</li>
                                <li>DWI PUSPITOWATI</li>
                                <li>EKA DEFI ANAWATI</li>
                                <li>LISHARYANTI</li>
                                <li>ELIS MAFRUROH</li>
                                <li>SYAMSIYAH</li>
                                <li>DEFI FELA YULIANTI</li>
                                <li>SITI MINUWAROH</li>
                                <li>YAYUK YUSWANTI</li>
                                <li>MISTRI</li>
                                <li>RUWIYAH</li>
                                <li>MARYATI</li>
                                <li>LULUK ROFI ROSIDAH</li>
                                <li>BINTI FATHROTIN</li>
                            </ol>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Kader Remaja</h4>
                            <ol class="list-decimal pl-5 text-gray-700 space-y-1 mb-6">
                                <li>ARMANDA DITA PARANTIKA</li>
                                <li>SUSI UTAMI</li>
                                <li>YETI LIANA</li>
                                <li>YUYUN KUSTINA</li>
                                <li>FITRIA DYAH KUMALANINGRUM</li>
                            </ol>

                            <h4 class="font-bold text-gray-900 mb-2">Kader Posbindu</h4>
                            <ol class="list-decimal pl-5 text-gray-700 space-y-1 mb-6">
                                <li>YULI ENDANG MEGAWATI</li>
                                <li>SIRI NURJANAH</li>
                                <li>MUSLIKAH</li>
                                <li>RESTU NUR JANNAH</li>
                                <li>ANITASARI</li>
                            </ol>

                            <h4 class="font-bold text-gray-900 mb-2">Kader Lansia</h4>
                            <ol class="list-decimal pl-5 text-gray-700 space-y-1">
                                <li>KHASANATUL FADILAH</li>
                                <li>SUDARMONO</li>
                                <li>ULFIANA DAIROTURROHMAH</li>
                                <li>ALYN NURJANAH</li>
                            </ol>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Kader Taman Posyandu</h4>
                            <ol class="list-decimal pl-5 text-gray-700 space-y-1 mb-6">
                                <li>DEVI DIAH RIZKA RAHMAWATI</li>
                                <li>ANNA SHOFIA ULFA</li>
                                <li>MAMIK SRIWAHYUNI</li>
                                <li>HASMA PERMATASARI .P.</li>
                            </ol>

                            <h4 class="font-bold text-gray-900 mb-2">Kader BKB</h4>
                            <ol class="list-decimal pl-5 text-gray-700 space-y-1">
                                <li>MAYA ANGGERINA</li>
                                <li>LAILATUL MUKHARROHMA</li>
                                <li>MINA RODIYANA</li>
                                <li>AWALUL ROHMA</li>
                                <li>SUSMIATI</li>
                                <li>ISTI DAMAYANTI</li>
                            </ol>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Kader PHBS</h4>
                            <ul class="list-disc pl-5 text-gray-700 space-y-1 mb-6">
                                <li>SITI NURJANNAH</li>
                            </ul>

                            <h4 class="font-bold text-gray-900 mb-2">Kader Jumantik</h4>
                            <ul class="list-disc pl-5 text-gray-700 space-y-1 mb-6">
                                <li>NINGSIH</li>
                                <li>SINARSIH</li>
                            </ul>

                            <h4 class="font-bold text-gray-900 mb-2">Kader Jiwa</h4>
                            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                                <li>PRIYO HERMAWAN</li>
                            </ul>
                        </div>
                    </div>
                </details>
            </div>

            <!-- PKK -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">PKK (Program Kesejahteraan Keluarga)</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="border-l-4 border-green-600 pl-4 py-1">
                        <h4 class="font-semibold text-gray-900">Ketua</h4>
                        <p class="text-gray-700">SITI NURHIDYATI, S.Pd.</p>
                    </div>
                    <div class="border-l-4 border-green-600 pl-4 py-1">
                        <h4 class="font-semibold text-gray-900">Wakil</h4>
                        <p class="text-gray-700">MISTRI</p>
                    </div>
                    <div class="border-l-4 border-green-600 pl-4 py-1">
                        <h4 class="font-semibold text-gray-900">Sekretaris</h4>
                        <p class="text-gray-700">SAPTA PUTRI</p>
                    </div>
                    <div class="border-l-4 border-green-600 pl-4 py-1">
                        <h4 class="font-semibold text-gray-900">Wakil Sekretaris</h4>
                        <p class="text-gray-700">DWI PUSPITOWATI</p>
                    </div>
                    <div class="border-l-4 border-green-600 pl-4 py-1">
                        <h4 class="font-semibold text-gray-900">Bendahara</h4>
                        <p class="text-gray-700">NINUK HARYATI</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 md:col-span-2">
                        <p class="text-gray-600 font-semibold mb-2">Pokja</p>
                        <ul class="text-gray-700 space-y-1">
                            <li><span class="font-semibold text-gray-900">POKJA I:</span> SUTILAH</li>
                            <li><span class="font-semibold text-gray-900">POKJA II:</span> LILIK PURWANTI</li>
                            <li><span class="font-semibold text-gray-900">POKJA III:</span> SITI ALIMAH</li>
                            <li><span class="font-semibold text-gray-900">POKJA IV:</span> SALBIYATI</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Karang Taruna -->
            <div class="bg-white border border-gray-200 rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Karang Taruna</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Pengurus</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li><span class="font-semibold text-gray-900">Ketua:</span> Nadham</li>
                            <li><span class="font-semibold text-gray-900">Wakil:</span> Arsyadha</li>
                            <li><span class="font-semibold text-gray-900">Sekretaris:</span> Laela</li>
                            <li><span class="font-semibold text-gray-900">Bendahara:</span> Eriana</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Anggota</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Restu, Anggun, Naza, Nisa, Nida, Yunita, Dewi, Amel, Ali, Dafa, Eko, Robi, Kiki, Hila, Ghulam, Arhan, Kalyan, Mifa, Tina, Isna, Zein, Burhan, Huda, Imma, Anggis, Ulfiana.
                        </p>
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
                        <p class="text-gray-900 font-bold">4.223 orang</p>
                        <p class="text-gray-600 text-xs">L: 2.840 • P: 1.383</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Kepala Keluarga</p>
                        <p class="text-gray-900 font-bold">1.035 KK</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Dukuh / Dusun</p>
                        <p class="text-gray-900 font-bold">3 (Siwalan I, II, III)</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Luas Wilayah</p>
                        <p class="text-gray-900 font-bold">190,67 Ha</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Ketinggian</p>
                        <p class="text-gray-900 font-bold">125 mdpl</p>
                    </div>
                </div>
            </div>

            <!-- Lingkungan Hidup -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Lingkungan Hidup</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 font-semibold">Bank Sampah</p>
                        <p class="text-gray-700">-</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Tata Kelola Sampah</p>
                        <p class="text-gray-700">-</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Ruang Terbuka Hijau</p>
                        <p class="text-gray-700">Siwalan Asri</p>
                    </div>
                </div>
            </div>

            <!-- Transformasi Digital -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Transformasi Digital</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 font-semibold">Website Desa</p>
                        <p class="text-gray-700">-</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Sarana Internet Desa</p>
                        <p class="text-gray-700">-</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Inovasi Desa</p>
                        <p class="text-gray-700">-</p>
                    </div>
                </div>
            </div>

            <!-- Kontak Kantor -->
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Kontak Kantor</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 font-semibold">Alamat</p>
                        <p class="text-gray-700">Desa Siwalan, Kecamatan Mlarak, Kabupaten Ponorogo, Jawa Timur</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Email</p>
                        <p class="text-gray-700">-</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Telepon</p>
                        <p class="text-gray-700">-</p>
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
        <div class="w-full h-96 bg-gray-200 rounded-lg overflow-hidden">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.6592346924326!2d111.51846657500646!3d-7.930613692093172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790af78ef4e9df%3A0xe95d424787bbe28!2sBalai%20Desa%20Siwalan!5e0!3m2!1sid!2sid!4v1763623006043!5m2!1sid!2sid"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</main>
@endsection
