@extends('admin.layouts.app')
@section('title', 'Daftar Pengaduan - Admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">Daftar Pengaduan Warga</h1>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">User</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Judul</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pengaduan as $index => $item)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $pengaduan->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                {{ \Illuminate\Support\Str::limit($item->title, 50) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('pengaduan.show', $item->uuid) }}"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 transition text-sm">
                                        Lihat
                                    </a>

                                    <form action="{{ route('pengaduan.destroy', $item->uuid) }}" method="POST"
                                        onsubmit="return confirm('Hapus pengaduan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada pengaduan</td>
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
