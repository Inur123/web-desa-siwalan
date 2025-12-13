@extends('admin.layouts.app')
@section('title', 'Pengaturan Template Surat - Admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Pengaturan Template Surat</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.settings.template-surat.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Logo Kop Surat -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Logo Kop Surat</h3>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Logo (Opsional)</label>

                            @if($settings['logo_kop_surat'] ?? null)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $settings['logo_kop_surat']) }}"
                                     alt="Logo"
                                     class="h-20 border rounded p-2">
                                <p class="text-xs text-gray-500 mt-1">Logo saat ini</p>
                            </div>
                            @endif

                            <input type="file" name="logo_kop_surat" accept="image/png,image/jpg,image/jpeg"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('logo_kop_surat') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Format: PNG (transparan recommended), JPG, JPEG. Max 1MB.</p>
                            <p class="text-xs text-blue-600 mt-1"><i class="fas fa-info-circle"></i> Ukuran optimal: 200x200px atau 300x300px untuk hasil terbaik</p>
                            @error('logo_kop_surat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kop Surat -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Informasi Kop Surat</h3>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kabupaten</label>
                                <input type="text" name="kop_surat_kabupaten" value="{{ old('kop_surat_kabupaten', $settings['kop_surat_kabupaten'] ?? '') }}"
                                    required placeholder="PEMERINTAH KABUPATEN ..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kop_surat_kabupaten') border-red-500 @enderror">
                                @error('kop_surat_kabupaten')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kecamatan</label>
                                <input type="text" name="kop_surat_kecamatan" value="{{ old('kop_surat_kecamatan', $settings['kop_surat_kecamatan'] ?? '') }}"
                                    required placeholder="KECAMATAN ..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kop_surat_kecamatan') border-red-500 @enderror">
                                @error('kop_surat_kecamatan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Desa</label>
                                <input type="text" name="kop_surat_desa" value="{{ old('kop_surat_desa', $settings['kop_surat_desa'] ?? '') }}"
                                    required placeholder="DESA ..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kop_surat_desa') border-red-500 @enderror">
                                @error('kop_surat_desa')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <input type="text" name="kop_surat_alamat" value="{{ old('kop_surat_alamat', $settings['kop_surat_alamat'] ?? '') }}"
                                    required placeholder="Jl. ..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kop_surat_alamat') border-red-500 @enderror">
                                @error('kop_surat_alamat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kontak (Email & Telepon)</label>
                                <input type="text" name="kop_surat_kontak" value="{{ old('kop_surat_kontak', $settings['kop_surat_kontak'] ?? '') }}"
                                    required placeholder="Email: ... | Telp: ..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kop_surat_kontak') border-red-500 @enderror">
                                @error('kop_surat_kontak')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pejabat Penandatangan -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Pejabat Penandatangan</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kepala Desa</label>
                                <input type="text" name="nama_kepala_desa" value="{{ old('nama_kepala_desa', $settings['nama_kepala_desa'] ?? '') }}"
                                    required placeholder="Nama lengkap Kepala Desa"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('nama_kepala_desa') border-red-500 @enderror">
                                @error('nama_kepala_desa')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NIP Kepala Desa</label>
                                <input type="text" name="nip_kepala_desa" value="{{ old('nip_kepala_desa', $settings['nip_kepala_desa'] ?? '') }}"
                                    required placeholder="NIP"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('nip_kepala_desa') border-red-500 @enderror">
                                @error('nip_kepala_desa')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="flex gap-3 pt-4 border-t">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                            <i class="fas fa-save"></i> Simpan Pengaturan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
