@extends('admin.layouts.app')
@section('title', 'Pengaturan WhatsApp (Fonnte) - Admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Pengaturan WhatsApp (Fonnte)</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h3 class="font-semibold text-blue-900 mb-2"><i class="fas fa-info-circle"></i> Informasi</h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• Fonnte digunakan untuk mengirim notifikasi WhatsApp otomatis</li>
                    <li>• Token bisa didapatkan dari <a href="https://fonnte.com" target="_blank" class="underline font-semibold">fonnte.com</a></li>
                    <li>• Nomor admin akan menerima notifikasi setiap ada pengajuan layanan baru</li>
                </ul>
            </div>

            <form action="{{ route('admin.settings.fonnte.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Token Fonnte -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Konfigurasi API Fonnte</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Token Fonnte <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="fonnte_token"
                                value="{{ old('fonnte_token', $settings['fonnte_token'] ?? '') }}"
                                required
                                placeholder="Masukkan token dari Fonnte.com"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('fonnte_token') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-key"></i> Dapatkan token di dashboard Fonnte.com setelah login
                            </p>
                            @error('fonnte_token')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Nomor Admin -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Nomor WhatsApp Penerima Notifikasi</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor WhatsApp Admin <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="fonnte_admin_phone"
    value="{{ old('fonnte_admin_phone', $settings['fonnte_admin_phone'] ?? '') }}"
    required
    placeholder="Contoh: 08123456789"
    minlength="10"
    maxlength="15"
    pattern="[0-9]+"
    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('fonnte_admin_phone') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fab fa-whatsapp"></i> Nomor ini akan menerima notifikasi setiap ada pengajuan layanan baru dari warga
                            </p>
                            @error('fontte_admin_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="flex gap-3 pt-4 border-t">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
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
