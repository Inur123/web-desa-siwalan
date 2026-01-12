<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Sktm;
use Illuminate\Http\Request;

class CekStatusLayananController extends Controller
{
    public function index()
    {
        return view('guest.cek-status-layanan', [
            'kode' => null,
            'data' => null,
            'notFound' => false,
            'jenis' => null,
        ]);
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'kode_layanan' => 'required|string|min:5|max:50',
        ], [
            'kode_layanan.required' => 'Kode layanan wajib diisi',
        ]);

        $kode = strtoupper(trim($validated['kode_layanan']));

        // Saat ini cek khusus SKTM
        $sktm = Sktm::where('kode_layanan', $kode)->first();

        if (!$sktm) {
            return view('guest.cek-status-layanan', [
                'kode' => $kode,
                'data' => null,
                'notFound' => true,
                'jenis' => null,
            ]);
        }

        return view('guest.cek-status-layanan', [
            'kode' => $kode,
            'data' => $sktm,
            'notFound' => false,
            'jenis' => 'SKTM',
        ]);
    }
}
