<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;

class Sktm extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
    'uuid',
    'kode_layanan',
    'nama',
    'nik',
    'ttl',
    'tempat_lahir',
    'alamat',
    'status_perkawinan',
    'no_hp',
    'nama_anak',
    'keperluan',
    'kk',
    'ktp',
    'pengantar_rt',
    'status',
];

    protected $casts = [
        'ttl' => 'date',
    ];

    // Enkripsi data saat menyimpan
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = Crypt::encryptString($value);
    }

    public function setNikAttribute($value)
    {
        $this->attributes['nik'] = Crypt::encryptString($value);
    }

    public function setTempatLahirAttribute($value)
    {
        $this->attributes['tempat_lahir'] = Crypt::encryptString($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = Crypt::encryptString($value);
    }

    public function setStatusPerkawinanAttribute($value)
    {
        $this->attributes['status_perkawinan'] = Crypt::encryptString($value);
    }

    public function setNoHpAttribute($value)
    {
        $this->attributes['no_hp'] = Crypt::encryptString($value);
    }

    public function setNamaAnakAttribute($value)
    {
        $this->attributes['nama_anak'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setKeperluanAttribute($value)
    {
        $this->attributes['keperluan'] = Crypt::encryptString($value);
    }

    public function setKkAttribute($value)
    {
        $this->attributes['kk'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setKtpAttribute($value)
    {
        $this->attributes['ktp'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setPengantarRtAttribute($value)
    {
        $this->attributes['pengantar_rt'] = $value ? Crypt::encryptString($value) : null;
    }

    // Dekripsi data saat mengambil
    public function getNamaAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getNikAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getTempatLahirAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getAlamatAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getStatusPerkawinanAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getNoHpAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getNamaAnakAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKeperluanAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKkAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKtpAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getPengantarRtAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    // Agar route model binding otomatis pakai uuid
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
