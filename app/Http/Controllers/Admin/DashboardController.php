<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Sktm;
use App\Models\Pengaduan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLayanan = Sktm::count();
        $totalPosts = Post::count();
        $totalPengaduan = Pengaduan::count();

        return view('admin.dashboard', compact('totalLayanan', 'totalPosts', 'totalPengaduan'));
    }
}
