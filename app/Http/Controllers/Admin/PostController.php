<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Daftar kategori berita desa
    private $kategoriOptions = [
        'Pemerintahan',
        'Kesehatan',
        'Pendidikan',
        'Lingkungan',
        'Acara',
    ];

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $kategori = $this->kategoriOptions;
        return view('admin.posts.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|in:' . implode(',', $this->kategoriOptions),
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil dibuat.');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $kategori = $this->kategoriOptions;
        return view('admin.posts.edit', compact('post', 'kategori'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|in:' . implode(',', $this->kategoriOptions),
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Berita berhasil dihapus.');
    }
}
