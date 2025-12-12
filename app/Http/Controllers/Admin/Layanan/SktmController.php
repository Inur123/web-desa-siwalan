<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Sktm;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SktmController extends Controller
{
    // Tampilkan semua pengajuan SKTM
    public function index()
    {
        $sktms = Sktm::latest()->paginate(10);
        return view('admin.layanan.sktm.index', compact('sktms'));
    }

    // Tampilkan detail pengajuan SKTM
    public function show(Sktm $sktm)
    {
        return view('admin.layanan.sktm.show', compact('sktm'));
    }

    // Update status pengajuan (diterima/ditolak)
    public function updateStatus(Request $request, Sktm $sktm)
    {
        // Cek apakah status sudah final (diterima atau ditolak)
        if ($sktm->status === 'diterima' || $sktm->status === 'ditolak') {
            return redirect()->back()->with('error', 'Status tidak dapat diubah karena pengajuan sudah ' . $sktm->status . '.');
        }

        $validated = $request->validate([
            'status' => 'required|in:baru,diterima,ditolak',
        ]);

        $sktm->update($validated);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    // Cetak surat SKTM dalam format PDF (preview di browser)
    public function cetak(Sktm $sktm)
    {
        // Hanya bisa cetak jika status diterima
        if ($sktm->status !== 'diterima') {
            return redirect()->back()->with('error', 'Surat hanya dapat dicetak untuk pengajuan yang sudah diterima.');
        }

        // Generate nomor surat
        $tahun = date('Y');
        $bulan = date('m');
        $nomorUrut = str_pad($sktm->id, 4, '0', STR_PAD_LEFT);
        $nomorSurat = "474.3/{$nomorUrut}/SKTM/{$bulan}/{$tahun}";

        // Get settings dari database
        $settings = Setting::all()->pluck('value', 'key');

        // Load view untuk PDF
        $pdf = Pdf::loadView('admin.layanan.sktm.cetak', [
            'sktm' => $sktm,
            'nomorSurat' => $nomorSurat,
            'settings' => $settings
        ]);

        // Set paper size dan orientation
        $pdf->setPaper('A4', 'portrait');

        // Stream PDF ke browser (preview dengan opsi download)
        $fileName = 'SKTM_' . str_replace(' ', '_', $sktm->nama) . '_' . date('Ymd') . '.pdf';
        return $pdf->stream($fileName);
    }

    // Hapus pengajuan
    public function destroy(Sktm $sktm)
    {
        // Hapus file yang diupload
        if ($sktm->kk) Storage::disk('public')->delete($sktm->kk);
        if ($sktm->ktp) Storage::disk('public')->delete($sktm->ktp);
        if ($sktm->pengantar_rt) Storage::disk('public')->delete($sktm->pengantar_rt);

        $sktm->delete();

        return redirect()->route('admin.sktm.index')->with('success', 'Pengajuan SKTM berhasil dihapus.');
    }

    // Method tidak digunakan untuk admin
    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(Sktm $sktm) { abort(404); }
    public function update(Request $request, Sktm $sktm) { abort(404); }
}
