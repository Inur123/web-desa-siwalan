<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;

class SuratKeteranganDomisili extends Model
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
        'nik',
        'jenis_kelamin',
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'status_perkawinan',
        'alamat',
        'no_hp',
        'rt',
        'rw',
        'dukuh',
        'tahun_domisili',
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

    public function setTempatLahirAttribute($value)
    {
        $this->attributes['tempat_lahir'] = Crypt::encryptString($value);
    }

    public function setNikAttribute($value)
    {
        $this->attributes['nik'] = Crypt::encryptString($value);
    }

    public function setJenisKelaminAttribute($value)
    {
        $this->attributes['jenis_kelamin'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setKewarganegaraanAttribute($value)
    {
        $this->attributes['kewarganegaraan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setAgamaAttribute($value)
    {
        $this->attributes['agama'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setPekerjaanAttribute($value)
    {
        $this->attributes['pekerjaan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setStatusPerkawinanAttribute($value)
    {
        $this->attributes['status_perkawinan'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = Crypt::encryptString($value);
    }

    public function setNoHpAttribute($value)
    {
        $this->attributes['no_hp'] = Crypt::encryptString($value);
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
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getTempatLahirAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getNikAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getJenisKelaminAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKewarganegaraanAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getAgamaAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getPekerjaanAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getStatusPerkawinanAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getAlamatAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
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

    public function getKkAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKtpAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getPengantarRtAttribute($value)
    {
        if (!$value) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
