<?php

namespace App\Http\Controllers\Guest\Layanan;

use App\Models\Sktm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FontteService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SktmController extends Controller
{
    public function index()
    {
        return view('guest.layanan.sktm');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'nik' => 'required|string|digits:16',
            'ttl' => 'required|date|before:today',
            'tempat_lahir' => 'required|string|min:3|max:255',
            'alamat' => 'required|string|min:10|max:500',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'no_hp' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'nama_anak' => 'nullable|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'keperluan' => 'required|string|min:3|max:255',
            'kk' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'ktp' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'pengantar_rt' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi',
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus 16 digit',
            'ttl.required' => 'Tanggal lahir wajib diisi',
            'ttl.before' => 'Tanggal lahir harus sebelum hari ini',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih',
            'status_perkawinan.in' => 'Status perkawinan tidak valid',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.max' => 'Nomor HP maksimal 15 digit',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka',
            'nama_anak.min' => 'Nama anak minimal 3 karakter',
            'nama_anak.regex' => 'Nama anak hanya boleh berisi huruf dan spasi',
            'keperluan.required' => 'Keperluan wajib diisi',
            'keperluan.min' => 'Keperluan minimal 3 karakter',
            'kk.mimes' => 'Kartu Keluarga harus berupa file JPG, PNG, atau PDF',
            'ktp.mimes' => 'KTP harus berupa file JPG, PNG, atau PDF',
            'pengantar_rt.mimes' => 'Pengantar RT harus berupa file JPG, PNG, atau PDF',
        ]);

        // UUID
        $validated['uuid'] = Str::uuid();

        // Kode Layanan (bukan nomor surat)
        // Format: SKTM-YYYYMMDD-ABCDE
        $kodeLayanan = $this->generateKodeLayanan();

        // Upload file (jalan hanya jika ada file)
        if ($request->hasFile('kk')) {
            $validated['kk'] = $request->file('kk')->store('sktm/kk', 'public');
        }
        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp')->store('sktm/ktp', 'public');
        }
        if ($request->hasFile('pengantar_rt')) {
            $validated['pengantar_rt'] = $request->file('pengantar_rt')->store('sktm/pengantar_rt', 'public');
        }

        $dataToCreate = [
            'uuid' => $validated['uuid'],
            'kode_layanan' => $kodeLayanan, // ✅ dipakai untuk cek status
            'nama' => strip_tags($validated['nama']),
            'nik' => strip_tags($validated['nik']),
            'ttl' => $validated['ttl'],
            'tempat_lahir' => strip_tags($validated['tempat_lahir']),
            'alamat' => strip_tags($validated['alamat']),
            'status_perkawinan' => strip_tags($validated['status_perkawinan']),
            'no_hp' => strip_tags($validated['no_hp']),
            'nama_anak' => isset($validated['nama_anak']) ? strip_tags($validated['nama_anak']) : null,
            'keperluan' => strip_tags($validated['keperluan']),
            'kk' => $validated['kk'] ?? null,
            'ktp' => $validated['ktp'] ?? null,
            'pengantar_rt' => $validated['pengantar_rt'] ?? null,
            // status default dari migration: 'baru'
        ];

        $sktm = Sktm::create($dataToCreate);

        $this->sendWhatsAppNotification($sktm);

        return redirect()->back()->with(
            'success',
            "Pengajuan SKTM berhasil dikirim! Kode Layanan Anda: {$sktm->kode_layanan}. Notifikasi telah dikirim ke WhatsApp Anda."
        );
    }

    /**
     * Generate kode layanan unik.
     * Pastikan kolom kode_layanan di DB dibuat UNIQUE.
     */
    private function generateKodeLayanan(): string
    {
        do {
            $kode = 'SKTM-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Sktm::where('kode_layanan', $kode)->exists());

        return $kode;
    }

    private function sendWhatsAppNotification($sktm)
    {
        try {
            $fontte = new FontteService();
            $fontte->sendMessage($sktm->no_hp, $this->buildPesanUser($sktm));
            $fontte->sendToAdmin($this->buildPesanAdmin($sktm));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi WhatsApp: ' . $e->getMessage());
        }
    }

    private function buildPesanUser($sktm)
    {
        $pesan = "🔔 *NOTIFIKASI PENGAJUAN SKTM*\n\n";
        $pesan .= "Yth. Bapak/Ibu *{$sktm->nama}*,\n\n";
        $pesan .= "Pengajuan SKTM Anda telah *BERHASIL DITERIMA* oleh sistem.\n\n";

        $pesan .= "🔑 *Kode Layanan:* *{$sktm->kode_layanan}*\n";
        $pesan .= "Simpan kode ini untuk *cek status pengajuan*.\n\n";

        $pesan .= "📋 *Detail Pengajuan:*\n";
        $pesan .= "• Nama: {$sktm->nama}\n";
        $pesan .= "• NIK: {$sktm->nik}\n";
        $pesan .= "• Keperluan: {$sktm->keperluan}\n";

        if ($sktm->nama_anak) {
            $pesan .= "• Nama Anak: {$sktm->nama_anak}\n";
        }

        $pesan .= "• Tanggal Pengajuan: " . now()->format('d/m/Y H:i') . "\n";
        $pesan .= "• Status: *Menunggu Verifikasi*\n\n";
        $pesan .= "⏳ Pengajuan Anda akan segera diproses oleh petugas desa.\n\n";
        $pesan .= "Terima kasih telah menggunakan layanan Desa Siwalan.\n\n";
        $pesan .= "_Pesan ini dikirim otomatis, mohon tidak membalas._";

        return $pesan;
    }

    private function buildPesanAdmin($sktm)
    {
        $pesan = "🚨 *PENGAJUAN SKTM BARU*\n\n";
        $pesan .= "Ada pengajuan SKTM baru dari warga yang perlu segera ditindaklanjuti.\n\n";

        $pesan .= "🔑 *Kode Layanan:* {$sktm->kode_layanan}\n\n";

        $pesan .= "👤 *Data Pemohon:*\n";
        $pesan .= "• Nama: {$sktm->nama}\n";
        $pesan .= "• NIK: {$sktm->nik}\n";
        $pesan .= "• No. HP: {$sktm->no_hp}\n";
        $pesan .= "• Tempat/Tgl Lahir: {$sktm->tempat_lahir}, " . date('d/m/Y', strtotime($sktm->ttl)) . "\n";
        $pesan .= "• Alamat: {$sktm->alamat}\n";
        $pesan .= "• Status Perkawinan: {$sktm->status_perkawinan}\n";

        if ($sktm->nama_anak) {
            $pesan .= "• Nama Anak: {$sktm->nama_anak}\n";
        }

        $pesan .= "• Keperluan: {$sktm->keperluan}\n";
        $pesan .= "• Waktu Pengajuan: " . now()->format('d/m/Y H:i') . " WIB\n\n";
        $pesan .= "📌 Silakan login ke dashboard admin untuk memverifikasi dan memproses pengajuan ini.\n\n";
        $pesan .= "_Pesan otomatis dari Sistem Desa Siwalan_";

        return $pesan;
    }
}
