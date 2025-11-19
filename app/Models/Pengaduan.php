<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'content',
        'tanggal',
        'foto',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
