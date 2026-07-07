<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;

class SuratKehilangan extends Model
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
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'status_perkawinan',
        'alamat',
        'no_hp',
        'barang_hilang',
        'keterangan',
        'tanggal_hilang',
        'waktu_hilang',
        'tempat_hilang',
        'kk',
        'ktp',
        'pengantar_rt',
        'status',
        'alasan_ditolak',
    ];

    protected $casts = [
        'ttl' => 'date',
        'tanggal_hilang' => 'date',
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

    public function setBarangHilangAttribute($value)
    {
        $this->attributes['barang_hilang'] = Crypt::encryptString($value);
    }

    public function setKeteranganAttribute($value)
    {
        $this->attributes['keterangan'] = Crypt::encryptString($value);
    }

    public function setWaktuHilangAttribute($value)
    {
        $this->attributes['waktu_hilang'] = $value ? Crypt::encryptString($value) : null;
    }

    public function setTempatHilangAttribute($value)
    {
        $this->attributes['tempat_hilang'] = $value ? Crypt::encryptString($value) : null;
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

    public function getTempatLahirAttribute($value)
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

    public function getKewarganegaraanAttribute($value)
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

    public function getPekerjaanAttribute($value)
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
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getBarangHilangAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getKeteranganAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getWaktuHilangAttribute($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getTempatHilangAttribute($value)
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
