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
    'tempat_lahir',
    'ttl',
    'jenis_kelamin',
    'kewarganegaraan',
    'pendidikan',
    'pekerjaan',
    'status_perkawinan',
    'nik',
    'agama',
    'alamat',
    'no_hp',
    'keperluan',
    'kk',
    'ktp',
    'pengantar_rt',
    'status',
    'alasan_ditolak',
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

    public function setNoHpAttribute($value)
    {
        $this->attributes['no_hp'] = Crypt::encryptString($value);
    }

    public function setStatusPerkawinanAttribute($value)
    {
        $this->attributes['status_perkawinan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setJenisKelaminAttribute($value)
    {
        $this->attributes['jenis_kelamin'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setKewarganegaraanAttribute($value)
    {
        $this->attributes['kewarganegaraan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setPendidikanAttribute($value)
    {
        $this->attributes['pendidikan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setPekerjaanAttribute($value)
    {
        $this->attributes['pekerjaan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setAgamaAttribute($value)
    {
        $this->attributes['agama'] = $value ? Crypt::encryptString($value) : null;
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
    public function getNoHpAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
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

    public function getJenisKelaminAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKewarganegaraanAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getPendidikanAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getPekerjaanAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getAgamaAttribute($value)
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
