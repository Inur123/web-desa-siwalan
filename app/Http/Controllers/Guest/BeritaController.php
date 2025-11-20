<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BeritaController extends Controller
{
    public function index()
    {
        // Ambil 12 berita terbaru per halaman
        $posts = Post::latest()->paginate(12);
        return view('guest.berita', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('guest.detail-berita', compact('post'));
    }
}
