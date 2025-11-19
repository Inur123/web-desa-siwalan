@extends('warga.layouts.app')
@section('title', 'Daftar Pengaduan - Warga')

@section('content')
<div class="max-w-7xl mx-auto">

    <!-- Header + Tambah Pengaduan -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold">Daftar Pengaduan Anda</h1>
            <p class="text-gray-600 text-sm">Lihat dan kelola pengaduan yang telah Anda kirim</p>
        </div>
        <a href="{{ route('guest.pengaduan') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg transition">
            Tambah Pengaduan
        </a>
    </div>

    <!-- Complaints Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">No</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Judul</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Isi Pengaduan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Tanggal</th>

                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Lampiran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengaduans as $index => $p)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pengaduans->firstItem() + $index }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $p->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($p->content, 50) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y H:i') }}</td>
                        <td class="px-6 py-4">
                            @if($p->foto)
                                <a href="{{ asset('storage/' . $p->foto) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pengaduan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pengaduans->links() }}
    </div>

</div>
@endsection
