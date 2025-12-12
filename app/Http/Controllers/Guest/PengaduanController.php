<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('guest.pengaduan');
    }

   public function store(Request $request)
{
   $validated = $request->validate([
    'nama'    => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
    'no_hp'   => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
    'alamat'  => 'required|string|min:10|max:500',
    'title'   => 'required|string|min:5|max:255',
    'content' => 'required|string|min:10|max:2000',
    'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
], [
    'nama.required' => 'Nama wajib diisi',
    'nama.min' => 'Nama minimal 3 karakter',
    'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi',
    'no_hp.required' => 'Nomor HP wajib diisi',
    'no_hp.min' => 'Nomor HP minimal 10 digit',
    'no_hp.max' => 'Nomor HP maksimal 15 digit',
    'no_hp.regex' => 'Nomor HP hanya boleh berisi angka',
    'alamat.required' => 'Alamat wajib diisi',
    'alamat.min' => 'Alamat minimal 10 karakter',
    'alamat.max' => 'Alamat maksimal 500 karakter',
    'title.required' => 'Judul pengaduan wajib diisi',
    'title.min' => 'Judul minimal 5 karakter',
    'content.required' => 'Isi pengaduan wajib diisi',
    'content.min' => 'Isi pengaduan minimal 10 karakter',
    'content.max' => 'Isi pengaduan maksimal 2000 karakter',
]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('pengaduan', 'public');
    }

    // Sanitasi input tambahan (strip tags untuk keamanan)
    Pengaduan::create([
        'uuid'     => Str::uuid(),
        'nama'     => strip_tags($validated['nama']),
        'no_hp'    => strip_tags($validated['no_hp']),
        'alamat'   => strip_tags($validated['alamat']),
        'title'    => strip_tags($validated['title']),
        'content'  => strip_tags($validated['content']),
        'tanggal'  => now(),
        'foto'     => $fotoPath,
    ]);

    return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
}
}
