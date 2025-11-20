<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // Tampilkan semua pengaduan
public function index()
{
    $pengaduan = Pengaduan::with('user')->latest()->paginate(10);
    return view('admin.pengaduan.index', compact('pengaduan'));
}

    // Tampilkan detail pengaduan
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    // Hapus pengaduan
   public function destroy(Pengaduan $pengaduan)
{
    $pengaduan->delete();
    return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
}


    // Jika tidak perlu create/edit/update, bisa kosongkan
    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(Pengaduan $pengaduan) { abort(404); }
    public function update(Request $request, Pengaduan $pengaduan) { abort(404); }
}
