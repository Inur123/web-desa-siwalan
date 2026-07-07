<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Models\Sktm;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\FontteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'status' => 'required|in:diterima,ditolak',
            'alasan_ditolak' => 'required_if:status,ditolak|nullable|string|max:1000',
        ]);

        $sktm->update($validated);

        // Kirim notifikasi WA ke user jika status diterima/ditolak
        if (in_array($validated['status'], ['diterima', 'ditolak'])) {
            try {
                $fontte = new FontteService();
                $pesan = $this->buildStatusNotifUser($sktm, $validated['status']);
                $fontte->sendMessage($sktm->no_hp, $pesan);
            } catch (\Exception $e) {
                Log::error('Gagal kirim WA status SKTM: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    private function buildStatusNotifUser($sktm, $status)
    {
        // Pakai kode layanan (bukan nomor surat)
        $kode = $sktm->kode_layanan ?? '-';

        if ($status === 'diterima') {
            return "✅ *PENGAJUAN SKTM DITERIMA*\n\n"
                . "Yth. Bapak/Ibu *{$sktm->nama}*,\n\n"
                . "Pengajuan Surat Keterangan Tidak Mampu (SKTM) Anda telah *DITERIMA*.\n\n"
                . "🔑 *Kode Layanan:* *{$kode}*\n"
                . "Silakan datang ke kantor desa untuk mengambil surat Anda.\n\n"
                . "Terima kasih telah menggunakan layanan Desa Siwalan.";
        }

        return "❌ *PENGAJUAN SKTM DITOLAK*\n\n"
            . "Yth. Bapak/Ibu *{$sktm->nama}*,\n\n"
            . "Mohon maaf, pengajuan SKTM Anda *DITOLAK*.\n\n"
            . "🔑 *Kode Layanan:* *{$kode}*\n"
            . "• *Alasan Penolakan:* " . ($sktm->alasan_ditolak ?? 'Berkas kurang lengkap atau data belum sesuai.') . "\n\n"
            . "Silakan lengkapi berkas atau hubungi perangkat desa untuk informasi lebih lanjut.\n\n"
            . "Terima kasih.";
    }

    // Cetak surat SKTM dalam format PDF (preview di browser)
    public function cetak(Sktm $sktm)
    {
        // Hanya bisa cetak jika status diterima
        if ($sktm->status !== 'diterima') {
            return redirect()->back()->with('error', 'Surat hanya dapat dicetak untuk pengajuan yang sudah diterima.');
        }

        // Get settings dari database
        $settings = Setting::all()->pluck('value', 'key');

        // ✅ HAPUS nomor surat, ganti kirim kode layanan ke view (kalau mau ditampilkan)
        $pdf = Pdf::loadView('admin.layanan.sktm.cetak', [
            'sktm' => $sktm,
            'kodeLayanan' => $sktm->kode_layanan, // optional di template
            'settings' => $settings
        ]);

        $pdf->setPaper('legal', 'portrait');

        // Nama file PDF pakai kode layanan biar rapi
        $fileName = 'SKTM_' . ($sktm->kode_layanan ?? 'KODE') . '_' . date('Ymd') . '.pdf';
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
    public function create()
    {
        abort(404);
    }
    public function store(Request $request)
    {
        abort(404);
    }
    public function edit(Sktm $sktm)
    {
        abort(404);
    }
    public function update(Request $request, Sktm $sktm)
    {
        abort(404);
    }
}
