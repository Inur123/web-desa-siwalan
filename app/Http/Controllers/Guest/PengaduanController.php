<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('guest.pengaduan');
    }

   public function store(Request $request)
{
   $request->validate([
    'title'   => 'required|string|max:255',
    'content' => 'required|string',
    'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // hanya JPG & PNG, max 2MB
]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('pengaduan', 'public');
    }

    Pengaduan::create([
        'uuid'     => Str::uuid(),
        'user_id'  => Auth::user()->id, // UUID user
        'title'    => $request->title,
        'content'  => $request->content,
        'tanggal'  => now(),
        'foto'     => $fotoPath,
    ]);

    return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
}
}
