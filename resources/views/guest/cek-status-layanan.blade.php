@extends('guest.layouts.app')
@section('title', 'Cek Status Layanan - Desa Siwalan')

@section('content')
    <main class="container mx-auto px-4 py-8 max-w-5xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Cek Status Layanan</h1>
            <p class="text-gray-600">Masukkan Kode Layanan untuk melihat status pengajuan</p>
        </div>

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

        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mb-6">
            <form action="{{ route('guest.cek-status-layanan.check') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Kode Layanan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_layanan" value="{{ old('kode_layanan', $kode) }}"
                        placeholder="Contoh: SKTM-20260112-ABCDE atau SKH-20260112-ABCDE"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"
                        required>
                    <p class="text-xs text-gray-600 mt-1">
                        Kode layanan didapat dari notifikasi WhatsApp setelah pengajuan.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                        Cek Status
                    </button>

                    <a href="{{ route('guest.cek-status-layanan') }}"
                        class="w-full sm:w-auto text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition">
                        Clear
                    </a>
                </div>
            </form>

        </div>

        @if ($notFound)
            <div class="p-5 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg">
                <p class="font-semibold">Data tidak ditemukan.</p>
                <p class="text-sm mt-1">Pastikan kode layanan yang Anda masukkan benar.</p>
            </div>
        @endif

        @if ($data)
            @php
                $statusLabel = match ($data->status) {
                    'baru' => 'Menunggu Verifikasi',
                    'diterima' => 'Diterima (Silakan ambil surat di kantor desa)',
                    'ditolak' => 'Ditolak',
                    default => ucfirst($data->status),
                };

                $badgeClass = match ($data->status) {
                    'baru' => 'bg-blue-100 text-blue-800 border-blue-200',
                    'diterima' => 'bg-green-100 text-green-800 border-green-200',
                    'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                    default => 'bg-gray-100 text-gray-800 border-gray-200',
                };
            @endphp

            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Hasil Pencarian</h2>
                        <p class="text-sm text-gray-600 mt-1">
                            Jenis Layanan: <span class="font-semibold">{{ $jenis }}</span>
                        </p>
                    </div>

                    <div class="px-3 py-2 rounded-lg border text-sm font-semibold {{ $badgeClass }}">
                        {{ $statusLabel }}
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Kode Layanan</p>
                        <p class="text-gray-900 font-bold">{{ $data->kode_layanan }}</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Tanggal Pengajuan</p>
                        <p class="text-gray-900 font-bold">{{ $data->created_at?->format('d/m/Y H:i') }} WIB</p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Nama Pemohon</p>
                        <p class="text-gray-900 font-bold">{{ $data->nama }}</p>
                    </div>

                    @if($jenis === 'SKTM')
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Keperluan</p>
                        <p class="text-gray-900 font-bold">{{ $data->keperluan }}</p>
                    </div>
                    @else
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-600 font-semibold">Barang Hilang</p>
                        <p class="text-gray-900 font-bold">{{ $data->barang_hilang }}</p>
                    </div>
                    @endif
                </div>

                @if ($data->status === 'ditolak')
                    <div class="mt-5 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 text-sm">
                        <p class="font-semibold">Pengajuan ditolak.</p>
                        <p class="mt-1">Silakan lengkapi berkas / perbaiki data, atau hubungi perangkat desa.</p>
                    </div>
                @endif
            </div>
        @endif
    </main>
@endsection
