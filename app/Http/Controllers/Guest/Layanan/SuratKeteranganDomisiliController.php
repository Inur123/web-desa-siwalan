<?php

namespace App\Http\Controllers\Guest\Layanan;

use App\Models\SuratKeteranganDomisili;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FontteService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SuratKeteranganDomisiliController extends Controller
{
    public function index()
    {
        return view('guest.layanan.surat-keterangan-domisili');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'tempat_lahir' => 'required|string|min:3|max:255',
            'ttl' => 'required|date|before:today',
            'nik' => 'required|string|digits:16',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'kewarganegaraan' => 'nullable|string|max:100',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'nullable|string|max:100',
            'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'alamat' => 'required|string|min:10|max:500',
            'no_hp' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'dukuh' => 'nullable|string|max:100',
            'tahun_domisili' => 'nullable|string|max:4',
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
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'kewarganegaraan.max' => 'Kewarganegaraan maksimal 100 karakter',
            'agama.in' => 'Agama tidak valid',
            'pekerjaan.max' => 'Pekerjaan maksimal 100 karakter',
            'status_perkawinan.in' => 'Status perkawinan tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'kk.mimes' => 'Kartu Keluarga harus berupa file JPG, PNG, atau PDF',
            'ktp.mimes' => 'KTP harus berupa file JPG, PNG, atau PDF',
            'pengantar_rt.mimes' => 'Pengantar RT harus berupa file JPG, PNG, atau PDF',
        ]);

        $validated['uuid'] = Str::uuid();
        $kodeLayanan = $this->generateKodeLayanan();

        if ($request->hasFile('kk')) {
            $validated['kk'] = $request->file('kk')->store('surat-domisili/kk', 'public');
        }
        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp')->store('surat-domisili/ktp', 'public');
        }
        if ($request->hasFile('pengantar_rt')) {
            $validated['pengantar_rt'] = $request->file('pengantar_rt')->store('surat-domisili/pengantar_rt', 'public');
        }

        $dataToCreate = [
            'uuid' => $validated['uuid'],
            'kode_layanan' => $kodeLayanan,
            'nama' => strip_tags($validated['nama']),
            'tempat_lahir' => strip_tags($validated['tempat_lahir']),
            'ttl' => $validated['ttl'],
            'nik' => strip_tags($validated['nik']),
            'jenis_kelamin' => isset($validated['jenis_kelamin']) ? strip_tags($validated['jenis_kelamin']) : null,
            'kewarganegaraan' => isset($validated['kewarganegaraan']) ? strip_tags($validated['kewarganegaraan']) : null,
            'agama' => isset($validated['agama']) ? strip_tags($validated['agama']) : null,
            'pekerjaan' => isset($validated['pekerjaan']) ? strip_tags($validated['pekerjaan']) : null,
            'status_perkawinan' => isset($validated['status_perkawinan']) ? strip_tags($validated['status_perkawinan']) : null,
            'alamat' => strip_tags($validated['alamat']),
            'no_hp' => strip_tags($validated['no_hp']),
            'rt' => isset($validated['rt']) ? strip_tags($validated['rt']) : null,
            'rw' => isset($validated['rw']) ? strip_tags($validated['rw']) : null,
            'dukuh' => isset($validated['dukuh']) ? strip_tags($validated['dukuh']) : null,
            'tahun_domisili' => isset($validated['tahun_domisili']) ? strip_tags($validated['tahun_domisili']) : null,
            'kk' => $validated['kk'] ?? null,
            'ktp' => $validated['ktp'] ?? null,
            'pengantar_rt' => $validated['pengantar_rt'] ?? null,
        ];

        $suratDomisili = SuratKeteranganDomisili::create($dataToCreate);
        $this->sendWhatsAppNotification($suratDomisili);

        return redirect()->back()->with(
            'success',
            "Pengajuan Surat Keterangan Domisili berhasil dikirim! Kode Layanan Anda: {$suratDomisili->kode_layanan}."
        );
    }

    private function generateKodeLayanan(): string
    {
        do {
            $kode = 'SKD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (SuratKeteranganDomisili::where('kode_layanan', $kode)->exists());
        return $kode;
    }

    private function sendWhatsAppNotification($suratDomisili)
    {
        try {
            $fontte = new FontteService();
            $fontte->sendMessage($suratDomisili->no_hp, $this->buildPesanUser($suratDomisili));
            $fontte->sendToAdmin($this->buildPesanAdmin($suratDomisili));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi WhatsApp: ' . $e->getMessage());
        }
    }

    private function buildPesanUser($suratDomisili)
    {
        $pesan = "🔔 *NOTIFIKASI PENGAJUAN SURAT KETERANGAN DOMISILI*\n\n";
        $pesan .= "Yth. Bapak/Ibu *{$suratDomisili->nama}*,\n\n";
        $pesan .= "Pengajuan Surat Keterangan Domisili Anda telah *BERHASIL DITERIMA* oleh sistem.\n\n";
        $pesan .= "🔑 *Kode Layanan:* *{$suratDomisili->kode_layanan}*\n";
        $pesan .= "Simpan kode ini untuk *cek status pengajuan*.\n\n";
        $pesan .= "📋 *Detail Pengajuan:*\n";
        $pesan .= "• Nama: {$suratDomisili->nama}\n";
        $pesan .= "• NIK: {$suratDomisili->nik}\n";
        $pesan .= "• Alamat: {$suratDomisili->alamat}\n";
        if ($suratDomisili->rt || $suratDomisili->rw) {
            $pesan .= "• RT/RW: " . ($suratDomisili->rt ?? '-') . "/" . ($suratDomisili->rw ?? '-') . "\n";
        }
        $pesan .= "• Tanggal Pengajuan: " . now()->format('d/m/Y H:i') . "\n";
        $pesan .= "• Status: *Menunggu Verifikasi*\n\n";
        $pesan .= "⏳ Pengajuan Anda akan segera diproses oleh petugas desa.\n\n";
        $pesan .= "Terima kasih telah menggunakan layanan Desa Siwalan.\n\n";
        $pesan .= "_Pesan ini dikirim otomatis, mohon tidak membalas._";
        return $pesan;
    }

    private function buildPesanAdmin($suratDomisili)
    {
        $pesan = "🚨 *PENGAJUAN SURAT KETERANGAN DOMISILI BARU*\n\n";
        $pesan .= "Ada pengajuan Surat Keterangan Domisili baru dari warga yang perlu segera ditindaklanjuti.\n\n";
        $pesan .= "🔑 *Kode Layanan:* {$suratDomisili->kode_layanan}\n\n";
        $pesan .= "👤 *Data Pemohon:*\n";
        $pesan .= "• Nama: {$suratDomisili->nama}\n";
        $pesan .= "• NIK: {$suratDomisili->nik}\n";
        $pesan .= "• No. HP: {$suratDomisili->no_hp}\n";
        $pesan .= "• Tempat/Tgl Lahir: {$suratDomisili->tempat_lahir}, " . date('d/m/Y', strtotime($suratDomisili->ttl)) . "\n";
        $pesan .= "• Alamat: {$suratDomisili->alamat}\n";
        if ($suratDomisili->rt || $suratDomisili->rw) {
            $pesan .= "• RT/RW: " . ($suratDomisili->rt ?? '-') . "/" . ($suratDomisili->rw ?? '-') . "\n";
        }
        if ($suratDomisili->status_perkawinan) {
            $pesan .= "• Status Perkawinan: {$suratDomisili->status_perkawinan}\n";
        }
        $pesan .= "• Waktu Pengajuan: " . now()->format('d/m/Y H:i') . " WIB\n\n";
        $pesan .= "📌 Silakan login ke dashboard admin untuk memverifikasi dan memproses pengajuan ini.\n\n";
        $pesan .= "_Pesan otomatis dari Sistem Desa Siwalan_";
        return $pesan;
    }
}
