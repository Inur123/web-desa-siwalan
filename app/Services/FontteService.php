<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FontteService
{
    protected $token;
    protected $baseUrl = 'https://api.fonnte.com';
    protected $adminPhone;

        public function __construct()
    {
        $this->token = Setting::get('fonnte_token', '');
        $this->adminPhone = Setting::get('fonnte_admin_phone', ''); // ✅ sesuai DB
    }


    /**
     * Kirim pesan WhatsApp
     *
     * @param string $target Nomor tujuan (format: 628xxx)
     * @param string $message Isi pesan
     * @return array
     */
    public function sendMessage($target, $message)
    {
        try {
            // Format nomor: hapus karakter non-digit, ganti 0 di depan dengan 62
            $target = preg_replace('/[^0-9]/', '', $target);
            if (substr($target, 0, 1) === '0') {
                $target = '62' . substr($target, 1);
            }

            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->baseUrl . '/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp sent successfully', [
                    'target' => $target,
                    'response' => $response->json()
                ]);
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            } else {
                Log::error('Failed to send WhatsApp', [
                    'target' => $target,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                return [
                    'success' => false,
                    'message' => 'Gagal mengirim WhatsApp'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Exception while sending WhatsApp', [
                'target' => $target,
                'error' => $e->getMessage()
            ]);
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Kirim pesan ke admin
     *
     * @param string $message Isi pesan yang sudah diformat
     * @return array
     */
    public function sendToAdmin($message)
    {
        return $this->sendMessage($this->adminPhone, $message);
    }
}
