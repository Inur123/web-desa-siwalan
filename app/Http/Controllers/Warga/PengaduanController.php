<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        // Menampilkan pengaduan milik user yang sedang login
        $pengaduans = Pengaduan::where('user_id', Auth::user()->id)
                        ->orderBy('tanggal', 'desc')
                        ->paginate(10);

        return view('warga.pengaduan.index', compact('pengaduans'));
    }
}
