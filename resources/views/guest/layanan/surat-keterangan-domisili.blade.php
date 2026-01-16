@extends('guest.layouts.app')
@section('title', 'Pengajuan Surat Keterangan Domisili - Desa Siwalan')

@section('content')
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Form Pengajuan Surat Keterangan Domisili</h1>
            <p class="text-gray-600">Silakan lengkapi formulir di bawah ini untuk mengajukan Surat Keterangan Domisili</p>
        </div>

        <div>
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

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

            <form action="{{ route('guest.surat-keterangan-domisili.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                @csrf

                <div class="space-y-6">
                    <!-- Data Pemohon Section -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Data Pemohon</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}" required
                                    placeholder="Masukkan nama lengkap" minlength="3" maxlength="255" pattern="[a-zA-Z\s]+"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('nama') border-red-500 @enderror">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                                    placeholder="Contoh: Ponorogo" minlength="3" maxlength="255"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('tempat_lahir') border-red-500 @enderror">
                                @error('tempat_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="ttl" value="{{ old('ttl') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('ttl') border-red-500 @enderror">
                                @error('ttl')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor KTP / NIK <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" value="{{ old('nik') }}" required minlength="16"
                                    maxlength="16" pattern="[0-9]{16}" placeholder="16 digit NIK"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('nik') border-red-500 @enderror">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('jenis_kelamin') border-red-500 @enderror">
                                    <option value="">Pilih Jenis Kelamin</option>
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
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Agama</label>
                                <select name="agama"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('agama') border-red-500 @enderror">
                                    <option value="">Pilih Agama</option>
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

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Pekerjaan</label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                    placeholder="Contoh: Petani, Wiraswasta" maxlength="100"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('pekerjaan') border-red-500 @enderror">
                                @error('pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Status Perkawinan</label>
                                <select name="status_perkawinan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('status_perkawinan') border-red-500 @enderror">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" rows="2" required placeholder="Masukkan alamat lengkap" minlength="10" maxlength="500"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">No. HP/WhatsApp <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_hp" value="{{ old('no_hp') }}" required
                                    placeholder="Contoh: 08123456789" minlength="10" maxlength="15" pattern="[0-9]+"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('no_hp') border-red-500 @enderror">
                                <p class="text-xs text-gray-600 mt-1">Untuk notifikasi status pengajuan via WhatsApp</p>
                                @error('no_hp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Data Domisili Section -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Data Domisili</h2>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">RT</label>
                                <input type="text" name="rt" value="{{ old('rt') }}"
                                    placeholder="Contoh: 001" maxlength="10"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('rt') border-red-500 @enderror">
                                @error('rt')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">RW</label>
                                <input type="text" name="rw" value="{{ old('rw') }}"
                                    placeholder="Contoh: 002" maxlength="10"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('rw') border-red-500 @enderror">
                                @error('rw')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Dukuh</label>
                                <input type="text" name="dukuh" value="{{ old('dukuh') }}"
                                    placeholder="Contoh: Cipondoh" maxlength="100"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('dukuh') border-red-500 @enderror">
                                @error('dukuh')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Berdomisili Sejak Tahun</label>
                                <input type="text" name="tahun_domisili" value="{{ old('tahun_domisili') }}"
                                    placeholder="Contoh: 2024" maxlength="4" pattern="[0-9]{4}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 @error('tahun_domisili') border-red-500 @enderror">
                                @error('tahun_domisili')
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
                        class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
