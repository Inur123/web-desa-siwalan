<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Sktm;
use App\Models\SuratKehilangan;
use App\Models\SuratKeteranganDomisili;
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

        // Cek berdasarkan prefix kode layanan
        if (str_starts_with($kode, 'SKTM-')) {
            $data = Sktm::where('kode_layanan', $kode)->first();
            $jenis = 'SKTM';
        } elseif (str_starts_with($kode, 'SKH-')) {
            $data = SuratKehilangan::where('kode_layanan', $kode)->first();
            $jenis = 'Surat Kehilangan';
        } elseif (str_starts_with($kode, 'SKD-')) {
            $data = SuratKeteranganDomisili::where('kode_layanan', $kode)->first();
            $jenis = 'Surat Keterangan Domisili';
        } else {
            // Coba cek ketiganya jika prefix tidak jelas
            $data = Sktm::where('kode_layanan', $kode)->first();
            if ($data) {
                $jenis = 'SKTM';
            } else {
                $data = SuratKehilangan::where('kode_layanan', $kode)->first();
                if ($data) {
                    $jenis = 'Surat Kehilangan';
                } else {
                    $data = SuratKeteranganDomisili::where('kode_layanan', $kode)->first();
                    $jenis = $data ? 'Surat Keterangan Domisili' : null;
                }
            }
        }

        if (!$data) {
            return view('guest.cek-status-layanan', [
                'kode' => $kode,
                'data' => null,
                'notFound' => true,
                'jenis' => null,
            ]);
        }

        return view('guest.cek-status-layanan', [
            'kode' => $kode,
            'data' => $data,
            'notFound' => false,
            'jenis' => $jenis,
        ]);
    }
}
