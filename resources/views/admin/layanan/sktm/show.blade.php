@extends('admin.layouts.app')
@section('title', 'Detail Pengajuan SKTM - Admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.sktm.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-6">Detail Pengajuan SKTM</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Informasi Pemohon</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Nama Lengkap</label>
                    <p class="font-medium text-gray-800">{{ $sktm->nama }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">NIK</label>
                    <p class="font-medium text-gray-800">{{ $sktm->nik }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Tempat Lahir</label>
                    <p class="font-medium text-gray-800">{{ $sktm->tempat_lahir }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Tanggal Lahir</label>
                    <p class="font-medium text-gray-800">{{ $sktm->ttl->format('d-m-Y') }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Status Perkawinan</label>
                    <p class="font-medium text-gray-800">{{ $sktm->status_perkawinan }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">No. HP</label>
                    <p class="font-medium text-gray-800">{{ $sktm->no_hp }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Alamat</label>
                    <p class="font-medium text-gray-800">{{ $sktm->alamat }}</p>
                </div>
                @if($sktm->nama_anak)
                <div>
                    <label class="text-sm text-gray-600">Nama Anak</label>
                    <p class="font-medium text-gray-800">{{ $sktm->nama_anak }}</p>
                </div>
                @endif
                <div>
                    <label class="text-sm text-gray-600">Keperluan</label>
                    <p class="font-medium text-gray-800">{{ $sktm->keperluan }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Dokumen Pendukung</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if($sktm->kk)
                <div>
                    <label class="text-sm text-gray-600 block mb-2">Kartu Keluarga</label>
                    <a href="{{ asset('storage/' . $sktm->kk) }}" target="_blank"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                        <i class="fas fa-file-image"></i> Lihat KK
                    </a>
                </div>
                @endif

                @if($sktm->ktp)
                <div>
                    <label class="text-sm text-gray-600 block mb-2">KTP</label>
                    <a href="{{ asset('storage/' . $sktm->ktp) }}" target="_blank"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                        <i class="fas fa-file-image"></i> Lihat KTP
                    </a>
                </div>
                @endif

                @if($sktm->pengantar_rt)
                <div>
                    <label class="text-sm text-gray-600 block mb-2">Pengantar RT</label>
                    <a href="{{ asset('storage/' . $sktm->pengantar_rt) }}" target="_blank"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                        <i class="fas fa-file-image"></i> Lihat Pengantar
                    </a>
                </div>
                @endif
            </div>

            @if(!$sktm->kk && !$sktm->ktp && !$sktm->pengantar_rt)
            <p class="text-gray-500 text-sm">Tidak ada dokumen yang dilampirkan</p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Status Pengajuan</h2>

            <div class="mb-4">
                <label class="text-sm text-gray-600">Status Saat Ini</label>
                <p class="text-lg font-medium">
                    @if($sktm->status === 'baru')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">Baru</span>
                    @elseif($sktm->status === 'diterima')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">Diterima</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full">Ditolak</span>
                    @endif
                </p>
            </div>

            @if($sktm->status === 'baru')
            <form action="{{ route('admin.sktm.updateStatus', $sktm->uuid) }}" method="POST" class="mt-6">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500">
                        <option value="diterima" {{ $sktm->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $sktm->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </form>
            @elseif($sktm->status === 'diterima')
            <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-sm text-gray-600 mb-4">
                    <i class="fas fa-check-circle text-green-500"></i>
                    Pengajuan telah <strong>diterima</strong>. Anda dapat mencetak surat SKTM sekarang.
                </p>
                <a href="{{ route('admin.sktm.cetak', $sktm->uuid) }}"
                   target="_blank"
                   class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-file-pdf"></i> Lihat & Cetak Surat PDF
                </a>
            </div>
            @else
            <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-lock text-gray-400"></i>
                    Status tidak dapat diubah karena pengajuan sudah <strong>{{ $sktm->status }}</strong>.
                    Status final tidak dapat diubah kembali.
                </p>
            </div>
            @endif
        </div>

        <div class="mt-6 text-sm text-gray-600">
            <p>Tanggal Pengajuan: <strong>{{ $sktm->created_at->format('d M Y, H:i') }}</strong></p>
        </div>
    </div>
@endsection
