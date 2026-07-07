<?php

namespace App\Http\Controllers\Guest\Layanan;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SuratKehilangan;
use App\Services\FontteService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SuratKehilanganController extends Controller
{
    public function index()
    {
        return view('guest.layanan.surat-kehilangan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'tempat_lahir' => 'required|string|min:3|max:255',
            'ttl' => 'required|date|before:today',
            'nik' => 'required|string|digits:16',
            'kewarganegaraan' => 'nullable|string|max:100',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'nullable|string|max:100',
            'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'alamat' => 'required|string|min:10|max:500',
            'no_hp' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'barang_hilang' => 'required|string|min:3|max:255',
            'keterangan' => 'required|string|min:10',
            'tanggal_hilang' => 'required|date|before_or_equal:today',
            'waktu_hilang' => 'nullable|string|max:50',
            'tempat_hilang' => 'nullable|string|max:255',
            'kk' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'ktp' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'pengantar_rt' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter',
            'ttl.required' => 'Tanggal lahir wajib diisi',
            'ttl.before' => 'Tanggal lahir harus sebelum hari ini',
            'nik.required' => 'NIK wajib diisi',
            'nik.digits' => 'NIK harus 16 digit',
            'kewarganegaraan.max' => 'Kewarganegaraan maksimal 100 karakter',
            'agama.in' => 'Agama tidak valid',
            'pekerjaan.max' => 'Pekerjaan maksimal 100 karakter',
            'status_perkawinan.in' => 'Status perkawinan tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'barang_hilang.required' => 'Barang yang hilang wajib diisi',
            'barang_hilang.min' => 'Barang yang hilang minimal 3 karakter',
            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.min' => 'Keterangan minimal 10 karakter',
            'tanggal_hilang.required' => 'Tanggal kehilangan wajib diisi',
            'tanggal_hilang.before_or_equal' => 'Tanggal kehilangan tidak boleh di masa depan',
            'waktu_hilang.max' => 'Waktu kehilangan maksimal 50 karakter',
            'tempat_hilang.max' => 'Tempat kehilangan maksimal 255 karakter',
            'kk.mimes' => 'Kartu Keluarga harus berupa file JPG, PNG, atau PDF',
            'ktp.mimes' => 'KTP harus berupa file JPG, PNG, atau PDF',
            'pengantar_rt.mimes' => 'Pengantar RT harus berupa file JPG, PNG, atau PDF',
        ]);

        // UUID
        $validated['uuid'] = Str::uuid();

        // Kode Layanan
        // Format: SKH-YYYYMMDD-ABCDE
        $kodeLayanan = $this->generateKodeLayanan();

        // Upload file (jalan hanya jika ada file)
        if ($request->hasFile('kk')) {
            $validated['kk'] = $request->file('kk')->store('surat-kehilangan/kk', 'public');
        }
        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp')->store('surat-kehilangan/ktp', 'public');
        }
        if ($request->hasFile('pengantar_rt')) {
            $validated['pengantar_rt'] = $request->file('pengantar_rt')->store('surat-kehilangan/pengantar_rt', 'public');
        }

        $dataToCreate = [
            'uuid' => $validated['uuid'],
            'kode_layanan' => $kodeLayanan,
            'nama' => strip_tags($validated['nama']),
            'tempat_lahir' => strip_tags($validated['tempat_lahir']),
            'ttl' => $validated['ttl'],
            'nik' => strip_tags($validated['nik']),
            'kewarganegaraan' => isset($validated['kewarganegaraan']) ? strip_tags($validated['kewarganegaraan']) : null,
            'agama' => isset($validated['agama']) ? strip_tags($validated['agama']) : null,
            'pekerjaan' => isset($validated['pekerjaan']) ? strip_tags($validated['pekerjaan']) : null,
            'status_perkawinan' => isset($validated['status_perkawinan']) ? strip_tags($validated['status_perkawinan']) : null,
            'alamat' => strip_tags($validated['alamat']),
            'no_hp' => strip_tags($validated['no_hp']),
            'barang_hilang' => strip_tags($validated['barang_hilang']),
            'keterangan' => strip_tags($validated['keterangan']),
            'tanggal_hilang' => $validated['tanggal_hilang'],
            'waktu_hilang' => isset($validated['waktu_hilang']) ? strip_tags($validated['waktu_hilang']) : null,
            'tempat_hilang' => isset($validated['tempat_hilang']) ? strip_tags($validated['tempat_hilang']) : null,
            'kk' => $validated['kk'] ?? null,
            'ktp' => $validated['ktp'] ?? null,
            'pengantar_rt' => $validated['pengantar_rt'] ?? null,
        ];

        $suratKehilangan = SuratKehilangan::create($dataToCreate);

        $this->sendWhatsAppNotification($suratKehilangan);

        return redirect()->back()->with(
            'success',
            "Pengajuan Surat Kehilangan berhasil dikirim! Kode Layanan Anda: {$suratKehilangan->kode_layanan}."
        );
    }

    /**
     * Generate kode layanan unik.
     */
    private function generateKodeLayanan(): string
    {
        do {
            $kode = 'SKH-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (SuratKehilangan::where('kode_layanan', $kode)->exists());

        return $kode;
    }

    /**
     * Kirim notifikasi WhatsApp ke pemohon dan admin.
     */
    private function sendWhatsAppNotification(SuratKehilangan $suratKehilangan)
    {
        try {
            $fontte = new FontteService();

            // Kirim notifikasi ke pemohon
            if (!empty($suratKehilangan->no_hp)) {
                $fontte->sendMessage($suratKehilangan->no_hp, $this->buildPesanUser($suratKehilangan));
            }

            // Kirim notifikasi ke admin
            $fontte->sendToAdmin($this->buildPesanAdmin($suratKehilangan));

            Log::info('Notifikasi Surat Kehilangan berhasil dikirim', [
                'kode_layanan' => $suratKehilangan->kode_layanan,
                'nama' => $suratKehilangan->nama,
                'no_hp' => $suratKehilangan->no_hp,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi WA Surat Kehilangan: ' . $e->getMessage());
        }
    }

    private function buildPesanUser(SuratKehilangan $suratKehilangan)
    {
        $pesan = "🔔 *NOTIFIKASI PENGAJUAN SURAT KEHILANGAN*\n\n";
        $pesan .= "Yth. Bapak/Ibu *{$suratKehilangan->nama}*,\n\n";
        $pesan .= "Pengajuan Surat Kehilangan Anda telah *BERHASIL DITERIMA* oleh sistem.\n\n";

        $pesan .= "🔑 *Kode Layanan:* *{$suratKehilangan->kode_layanan}*\n";
        $pesan .= "Simpan kode ini untuk *cek status pengajuan*.\n\n";

        $pesan .= "📋 *Detail Pengajuan:*\n";
        $pesan .= "• Nama: {$suratKehilangan->nama}\n";
        $pesan .= "• NIK: {$suratKehilangan->nik}\n";
        $pesan .= "• No. HP: {$suratKehilangan->no_hp}\n";
        $pesan .= "• Tempat/Tgl Lahir: {$suratKehilangan->tempat_lahir}, " . Carbon::parse($suratKehilangan->ttl)->translatedFormat('d/m/Y') . "\n";
        $pesan .= "• Kewarganegaraan: " . ($suratKehilangan->kewarganegaraan ?? '-') . "\n";
        $pesan .= "• Agama: " . ($suratKehilangan->agama ?? '-') . "\n";
        $pesan .= "• Pekerjaan: " . ($suratKehilangan->pekerjaan ?? '-') . "\n";
        $pesan .= "• Status Perkawinan: " . ($suratKehilangan->status_perkawinan ?? '-') . "\n";
        $pesan .= "• Alamat: {$suratKehilangan->alamat}\n";
        $pesan .= "• Barang Hilang: {$suratKehilangan->barang_hilang}\n";
        $pesan .= "• Keterangan Kehilangan: {$suratKehilangan->keterangan}\n";
        $pesan .= "• Tanggal Hilang: " . Carbon::parse($suratKehilangan->tanggal_hilang)->translatedFormat('d/m/Y') . "\n";
        $pesan .= "• Waktu Hilang: " . ($suratKehilangan->waktu_hilang ?? '-') . "\n";
        $pesan .= "• Tempat Hilang: " . ($suratKehilangan->tempat_hilang ?? '-') . "\n";
        $pesan .= "• Tanggal Pengajuan: " . now()->translatedFormat('d/m/Y H:i') . " WIB\n";
        $pesan .= "• Status: *Menunggu Verifikasi*\n\n";
        $pesan .= "⏳ Pengajuan Anda akan segera diproses oleh petugas desa.\n\n";
        $pesan .= "Terima kasih telah menggunakan layanan Desa Siwalan.\n\n";
        $pesan .= "_Pesan ini dikirim otomatis, mohon tidak membalas._";

        return $pesan;
    }

    private function buildPesanAdmin(SuratKehilangan $suratKehilangan)
    {
        $pesan = "🚨 *PENGAJUAN SURAT KEHILANGAN BARU*\n\n";
        $pesan .= "Ada pengajuan Surat Kehilangan baru dari warga yang perlu segera ditindaklanjuti.\n\n";

        $pesan .= "🔑 *Kode Layanan:* {$suratKehilangan->kode_layanan}\n\n";

        $pesan .= "👤 *Data Pemohon:*\n";
        $pesan .= "• Nama: {$suratKehilangan->nama}\n";
        $pesan .= "• NIK: {$suratKehilangan->nik}\n";
        $pesan .= "• No. HP: {$suratKehilangan->no_hp}\n";
        $pesan .= "• Tempat/Tgl Lahir: {$suratKehilangan->tempat_lahir}, " . Carbon::parse($suratKehilangan->ttl)->translatedFormat('d/m/Y') . "\n";
        $pesan .= "• Kewarganegaraan: " . ($suratKehilangan->kewarganegaraan ?? '-') . "\n";
        $pesan .= "• Agama: " . ($suratKehilangan->agama ?? '-') . "\n";
        $pesan .= "• Pekerjaan: " . ($suratKehilangan->pekerjaan ?? '-') . "\n";
        $pesan .= "• Status Perkawinan: " . ($suratKehilangan->status_perkawinan ?? '-') . "\n";
        $pesan .= "• Alamat: {$suratKehilangan->alamat}\n";
        $pesan .= "• Barang Hilang: {$suratKehilangan->barang_hilang}\n";
        $pesan .= "• Keterangan Kehilangan: {$suratKehilangan->keterangan}\n";
        $pesan .= "• Tanggal Hilang: " . Carbon::parse($suratKehilangan->tanggal_hilang)->translatedFormat('d/m/Y') . "\n";
        $pesan .= "• Waktu Hilang: " . ($suratKehilangan->waktu_hilang ?? '-') . "\n";
        $pesan .= "• Tempat Hilang: " . ($suratKehilangan->tempat_hilang ?? '-') . "\n";
        $pesan .= "• Waktu Pengajuan: " . now()->translatedFormat('d/m/Y H:i') . " WIB\n\n";
        $pesan .= "📌 Silakan login ke dashboard admin untuk memverifikasi dan memproses pengajuan ini.\n\n";
        $pesan .= "_Pesan otomatis dari Sistem Desa Siwalan_";

        return $pesan;
    }
}
