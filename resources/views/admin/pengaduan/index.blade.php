@extends('admin.layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengaduan Warga</h1>
            <p class="text-gray-600">Kelola dan tanggapi pengaduan dari masyarakat</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($pengaduan as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $pengaduan->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Illuminate\Support\Str::limit($item->title, 40) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('pengaduan.show', $item->uuid) }}"
                                        class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-all duration-200 text-xs font-medium shadow-sm hover:shadow-md">
                                        <i class="fas fa-eye"></i>
                                        <span>Detail</span>
                                    </a>

                                    <form action="{{ route('pengaduan.destroy', $item->uuid) }}" method="POST"
                                        onsubmit="return confirm('Hapus pengaduan ini?')">
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
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-inbox text-5xl mb-3"></i>
                                    <p class="text-lg font-medium">Belum ada pengaduan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pengaduan->links() }}
        </div>
    </div>
@endsection
