@extends('guest.layouts.app')
@section('title', 'Pengajuan SKTM - Desa Siwalan')

@section('content')
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Form Pengajuan SKTM</h1>
            <p class="text-gray-600">Silakan lengkapi formulir di bawah ini untuk mengajukan Surat Keterangan Tidak Mampu</p>
        </div>

        <div>
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan alert error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-800 rounded-lg">
                    <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                    <ul class="list-disc ml-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('guest.sktm.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                @csrf

                <div class="space-y-6">
                    <!-- Data Pemohon Section -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Data Pemohon</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required
                                    placeholder="Masukkan nama lengkap" minlength="3" maxlength="255" pattern="[a-zA-Z\s]+"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('nama') border-red-500 @enderror">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tempat Lahir <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                    placeholder="Contoh: Ponorogo" minlength="3" maxlength="255"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('tempat_lahir') border-red-500 @enderror">
                                @error('tempat_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Lahir <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="ttl" value="{{ old('ttl') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('ttl') border-red-500 @enderror">
                                @error('ttl')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('jenis_kelamin') border-red-500 @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}"
                                    placeholder="Contoh: Indonesia" maxlength="100"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('kewarganegaraan') border-red-500 @enderror">
                                @error('kewarganegaraan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Pendidikan</label>
                                <select name="pendidikan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('pendidikan') border-red-500 @enderror">
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="Tidak Sekolah" {{ old('pendidikan') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                                    <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA/SMK" {{ old('pendidikan') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('pendidikan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Pekerjaan</label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                    placeholder="Contoh: Petani, Buruh, Wiraswasta" maxlength="100"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('pekerjaan') border-red-500 @enderror">
                                @error('pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Status Perkawinan</label>
                                <select name="status_perkawinan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('status_perkawinan') border-red-500 @enderror">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Belum Kawin"
                                        {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin
                                    </option>
                                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>
                                        Kawin</option>
                                    <option value="Cerai Hidup"
                                        {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup
                                    </option>
                                    <option value="Cerai Mati"
                                        {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati
                                    </option>
                                </select>
                                @error('status_perkawinan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor KTP / NIK <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nik" value="{{ old('nik') }}" required minlength="16"
                                    maxlength="16" placeholder="Masukkan NIK 16 digit" pattern="[0-9]{16}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('nik') border-red-500 @enderror">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Agama</label>
                                <select name="agama"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('agama') border-red-500 @enderror">
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Alamat Lengkap <span
                                        class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="2" required placeholder="Masukkan alamat lengkap" minlength="10" maxlength="500"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Keperluan <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="keperluan" value="{{ old('keperluan') }}" required
                                    minlength="3" maxlength="255" placeholder="Contoh: Beasiswa, Bantuan Sosial, dll"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('keperluan') border-red-500 @enderror">
                                @error('keperluan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Dokumen Pendukung Section -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                            Dokumen Pendukung <span class="text-gray-500 text-sm">(Opsional)</span>
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Kartu Keluarga</label>
                                <input type="file" name="kk"
                                    accept="image/jpeg,image/png,image/jpg,application/pdf"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('kk') border-red-500 @enderror">
                                <p class="text-xs text-gray-600 mt-1">Format: JPG, PNG, PDF. Max 2MB</p>
                                @error('kk')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">KTP</label>
                                <input type="file" name="ktp"
                                    accept="image/jpeg,image/png,image/jpg,application/pdf"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('ktp') border-red-500 @enderror">
                                <p class="text-xs text-gray-600 mt-1">Format: JPG, PNG, PDF. Max 2MB</p>
                                @error('ktp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Pengantar RT</label>
                                <input type="file" name="pengantar_rt"
                                    accept="image/jpeg,image/png,image/jpg,application/pdf"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('pengantar_rt') border-red-500 @enderror">
                                <p class="text-xs text-gray-600 mt-1">Format: JPG, PNG, PDF. Max 2MB</p>
                                @error('pengantar_rt')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                        <input type="checkbox" id="agree" class="w-4 h-4 rounded border-gray-300" required>
                        <label for="agree" class="text-sm text-gray-700">Saya menyatakan bahwa data yang saya isi
                            adalah benar dan dapat dipertanggungjawabkan</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                        <i class="fas fa-paper-plane"></i> Kirim Pengajuan SKTM
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Client-side validation untuk file upload
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = document.querySelectorAll('input[type="file"]');

            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const validTypes = ['image/jpeg', 'image/jpg', 'image/png',
                            'application/pdf'
                        ];

                        // Cek ukuran file (max 2MB)
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file maksimal 2MB');
                            this.value = '';
                            return;
                        }

                        // Cek tipe file
                        if (!validTypes.includes(file.type)) {
                            alert('Hanya file JPG, PNG, atau PDF yang diperbolehkan');
                            this.value = '';
                            return;
                        }
                    }
                });
            });
        });
    </script>
@endsection
