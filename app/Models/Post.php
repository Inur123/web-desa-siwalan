<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'deskripsi',
        'thumbnail',
        'tanggal',
        'kategori',
    ];
    protected $casts = [
    'tanggal' => 'date',
];

    // Boot method untuk membuat slug sebelum menyimpan
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = static::generateUniqueSlug($post->title);
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });
    }

    private static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $count = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = Str::slug($title) . '-' . $count++;
        }

        return $slug;
    }
    public function getRouteKeyName()
{
    return 'slug';
}

}
