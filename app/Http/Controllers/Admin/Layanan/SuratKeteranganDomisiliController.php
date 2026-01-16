<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Models\SuratKeteranganDomisili;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\FontteService;

class SuratKeteranganDomisiliController extends Controller
{
    public function index()
    {
        $suratDomisilis = SuratKeteranganDomisili::latest()->paginate(10);
        return view('admin.layanan.surat-keterangan-domisili.index', compact('suratDomisilis'));
    }

    public function show(SuratKeteranganDomisili $suratKeteranganDomisili)
    {
        return view('admin.layanan.surat-keterangan-domisili.show', compact('suratKeteranganDomisili'));
    }

    public function updateStatus(Request $request, SuratKeteranganDomisili $suratKeteranganDomisili)
    {
        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $suratKeteranganDomisili->update([
            'status' => $validated['status'],
        ]);

        $statusText = $validated['status'] === 'diterima' ? 'diterima' : 'ditolak';

        $this->sendStatusUpdateNotification($suratKeteranganDomisili, $statusText);

        return redirect()
            ->route('admin.surat-keterangan-domisili.show', $suratKeteranganDomisili->uuid)
            ->with('success', "Status pengajuan berhasil diubah menjadi {$statusText}");
    }

    private function sendStatusUpdateNotification(SuratKeteranganDomisili $suratDomisili, string $status)
    {
        try {
            $message = "🔔 *Update Status Pengajuan Surat Keterangan Domisili*\n\n";
            $message .= "Yth. {$suratDomisili->nama},\n\n";
            $message .= "Pengajuan Surat Keterangan Domisili Anda dengan:\n";
            $message .= "📋 Kode Layanan: *{$suratDomisili->kode_layanan}*\n\n";
            $message .= "Status: *" . strtoupper($status) . "*\n\n";

            if ($status === 'diterima') {
                $message .= "✅ Selamat! Pengajuan Anda telah disetujui.\n";
                $message .= "Silakan datang ke Kantor Desa Siwalan untuk mengambil surat.\n\n";
            } else {
                $message .= "❌ Mohon maaf, pengajuan Anda ditolak.\n";
                $message .= "Silakan hubungi Kantor Desa Siwalan untuk informasi lebih lanjut.\n\n";
            }

            $message .= "Terima kasih! 🙏";

            if (!empty($suratDomisili->no_hp)) {
                $fontte = new FontteService();
                $fontte->sendMessage($suratDomisili->no_hp, $message);
            }

            Log::info('Notifikasi status Surat Keterangan Domisili berhasil dikirim', [
                'kode_layanan' => $suratDomisili->kode_layanan,
                'status' => $status,
                'no_hp' => $suratDomisili->no_hp,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi status Surat Keterangan Domisili: ' . $e->getMessage());
        }
    }

    public function cetak(SuratKeteranganDomisili $suratKeteranganDomisili)
    {
        if ($suratKeteranganDomisili->status !== 'diterima') {
            return redirect()
                ->route('admin.surat-keterangan-domisili.show', $suratKeteranganDomisili->uuid)
                ->with('error', 'Hanya surat dengan status diterima yang dapat dicetak.');
        }

        $pdf = Pdf::loadView('admin.layanan.surat-keterangan-domisili.cetak', compact('suratKeteranganDomisili'));
        $pdf->setPaper('legal', 'portrait');

        return $pdf->stream('Surat_Keterangan_Domisili_' . $suratKeteranganDomisili->kode_layanan . '.pdf');
    }

    public function destroy(SuratKeteranganDomisili $suratKeteranganDomisili)
    {
        if ($suratKeteranganDomisili->kk) {
            Storage::disk('public')->delete($suratKeteranganDomisili->kk);
        }
        if ($suratKeteranganDomisili->ktp) {
            Storage::disk('public')->delete($suratKeteranganDomisili->ktp);
        }
        if ($suratKeteranganDomisili->pengantar_rt) {
            Storage::disk('public')->delete($suratKeteranganDomisili->pengantar_rt);
        }

        $suratKeteranganDomisili->delete();

        return redirect()
            ->route('admin.surat-keterangan-domisili.index')
            ->with('success', 'Pengajuan berhasil dihapus');
    }
}
