@extends('admin.layouts.app')
@section('title', 'Daftar Pengajuan Surat Kehilangan - Admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengajuan Surat Kehilangan</h1>
            <p class="text-gray-600">Kelola pengajuan Surat Keterangan Kehilangan dari masyarakat</p>
        </div>

        @if (session('success'))
            <div
                class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama
                            Pemohon</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Barang Hilang
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($suratKehilangans as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $suratKehilangans->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $item->nik }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Illuminate\Support\Str::limit($item->barang_hilang, 30) }}</td>
                            <td class="px-6 py-4 text-sm text-center">
                                @if ($item->status === 'baru')
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock"></i>
                                        Baru
                                    </span>
                                @elseif($item->status === 'diterima')
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle"></i>
                                        Diterima
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times-circle"></i>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.surat-kehilangan.show', $item->uuid) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                                        <i class="fas fa-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    <form action="{{ route('admin.surat-kehilangan.destroy', $item->uuid) }}" method="POST"
                                        onsubmit="return confirm('Hapus pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                                            <i class="fas fa-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                                    <p class="text-lg font-medium">Belum ada pengajuan surat kehilangan</p>
                                    <p class="text-sm text-gray-400 mt-2">Data akan muncul ketika ada pengajuan baru dari
                                        masyarakat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($suratKehilangans->hasPages())
            <div class="mt-6">
                {{ $suratKehilangans->links() }}
            </div>
        @endif
    </div>
@endsection
