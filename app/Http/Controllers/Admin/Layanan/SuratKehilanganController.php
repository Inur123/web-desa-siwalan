<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Models\SuratKehilangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\FontteService;

class SuratKehilanganController extends Controller
{
    public function index()
    {
        $suratKehilangans = SuratKehilangan::latest()->paginate(10);
        return view('admin.layanan.surat-kehilangan.index', compact('suratKehilangans'));
    }

    public function show(SuratKehilangan $suratKehilangan)
    {
        return view('admin.layanan.surat-kehilangan.show', compact('suratKehilangan'));
    }

    public function updateStatus(Request $request, SuratKehilangan $suratKehilangan)
    {
        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'alasan_ditolak' => 'required_if:status,ditolak|nullable|string|max:1000',
        ]);

        $suratKehilangan->update($validated);

        $statusText = $validated['status'] === 'diterima' ? 'diterima' : 'ditolak';

        // Kirim notifikasi WhatsApp
        $this->sendStatusUpdateNotification($suratKehilangan, $statusText);

        return redirect()
            ->route('admin.surat-kehilangan.show', $suratKehilangan->uuid)
            ->with('success', "Status pengajuan berhasil diubah menjadi {$statusText}");
    }

    private function sendStatusUpdateNotification(SuratKehilangan $suratKehilangan, string $status)
    {
        try {
            $message = "🔔 *Update Status Pengajuan Surat Kehilangan*\n\n";
            $message .= "Yth. {$suratKehilangan->nama},\n\n";
            $message .= "Pengajuan surat kehilangan Anda dengan:\n";
            $message .= "📋 Kode Layanan: *{$suratKehilangan->kode_layanan}*\n";
            $message .= "📦 Barang Hilang: *{$suratKehilangan->barang_hilang}*\n\n";
            $message .= "Status: *" . strtoupper($status) . "*\n\n";

            if ($status === 'diterima') {
                $message .= "✅ Selamat! Pengajuan Anda telah disetujui.\n";
                $message .= "Silakan datang ke Kantor Desa Siwalan untuk mengambil surat.\n\n";
            } else {
                $message .= "❌ Mohon maaf, pengajuan Anda ditolak.\n";
                $message .= "• *Alasan Penolakan:* " . ($suratKehilangan->alasan_ditolak ?? 'Berkas kurang lengkap atau data belum sesuai.') . "\n\n";
                $message .= "Silakan lengkapi berkas atau hubungi Kantor Desa Siwalan untuk informasi lebih lanjut.\n\n";
            }

            $message .= "Terima kasih! 🙏";

            if (!empty($suratKehilangan->no_hp)) {
                $fontte = new FontteService();
                $fontte->sendMessage($suratKehilangan->no_hp, $message);
            }

            Log::info('Notifikasi status Surat Kehilangan berhasil dikirim', [
                'kode_layanan' => $suratKehilangan->kode_layanan,
                'status' => $status,
                'no_hp' => $suratKehilangan->no_hp,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi status Surat Kehilangan: ' . $e->getMessage());
        }
    }

    public function cetak(SuratKehilangan $suratKehilangan)
    {
        if ($suratKehilangan->status !== 'diterima') {
            return redirect()
                ->route('admin.surat-kehilangan.show', $suratKehilangan->uuid)
                ->with('error', 'Hanya surat dengan status diterima yang dapat dicetak.');
        }

        $pdf = Pdf::loadView('admin.layanan.surat-kehilangan.cetak', compact('suratKehilangan'));
        $pdf->setPaper('legal', 'portrait');

        return $pdf->stream('Surat_Kehilangan_' . $suratKehilangan->kode_layanan . '.pdf');
    }

    public function destroy(SuratKehilangan $suratKehilangan)
    {
        // Hapus file jika ada
        if ($suratKehilangan->kk) {
            Storage::disk('public')->delete($suratKehilangan->kk);
        }
        if ($suratKehilangan->ktp) {
            Storage::disk('public')->delete($suratKehilangan->ktp);
        }
        if ($suratKehilangan->pengantar_rt) {
            Storage::disk('public')->delete($suratKehilangan->pengantar_rt);
        }

        $suratKehilangan->delete();

        return redirect()
            ->route('admin.surat-kehilangan.index')
            ->with('success', 'Pengajuan berhasil dihapus');
    }
}
