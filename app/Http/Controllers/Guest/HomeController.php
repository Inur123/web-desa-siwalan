<?php

namespace App\Http\Controllers\Guest;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 berita terbaru
        $posts = Post::latest('tanggal')->take(6)->get();

        return view('guest.home', compact('posts'));
    }
}
