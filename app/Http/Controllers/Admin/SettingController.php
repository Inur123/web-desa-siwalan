<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'kop_surat_kabupaten' => 'required|string|max:255',
            'kop_surat_kecamatan' => 'required|string|max:255',
            'kop_surat_desa' => 'required|string|max:255',
            'kop_surat_alamat' => 'required|string|max:500',
            'kop_surat_kontak' => 'required|string|max:500',
            'nama_kepala_desa' => 'required|string|max:255',
            'nip_kepala_desa' => 'required|string|max:50',
            'logo_kop_surat' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo_kop_surat')) {
            // Hapus logo lama jika ada
            $oldLogo = Setting::get('logo_kop_surat');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Upload logo baru
            $logoPath = $request->file('logo_kop_surat')->store('settings', 'public');
            Setting::set('logo_kop_surat', $logoPath);
        }

        // Update text settings
        foreach ($validated as $key => $value) {
            if ($key !== 'logo_kop_surat') {
                Setting::set($key, $value);
            }
        }

        return redirect()->back()->with('success', 'Pengaturan template surat berhasil diperbarui.');
    }
}
