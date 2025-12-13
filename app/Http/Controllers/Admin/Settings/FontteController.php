<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FontteController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.fonnte', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'fonnte_token' => 'required|string|max:255',
            'fonnte_admin_phone' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
        ], [
            'fonnte_token.required' => 'Token Fonnte wajib diisi',
            'fonnte_token.max' => 'Token Fonnte maksimal 255 karakter',
            'fonnte_admin_phone.required' => 'Nomor WhatsApp admin wajib diisi',
            'fonnte_admin_phone.min' => 'Nomor WhatsApp minimal 10 digit',
            'fonnte_admin_phone.max' => 'Nomor WhatsApp maksimal 15 digit',
            'fonnte_admin_phone.regex' => 'Nomor WhatsApp hanya boleh berisi angka',
        ]);

        // Update settings
        Setting::set('fonnte_token', $validated['fonnte_token']);
        Setting::set('fonnte_admin_phone', $validated['fonnte_admin_phone']);

        return redirect()->back()->with('success', 'Pengaturan Fonnte berhasil diperbarui.');
    }
}
