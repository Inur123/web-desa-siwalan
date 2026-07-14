# Website Desa Siwalan (Web Desa Siwalan)

Sistem Informasi Pelayanan Mandiri Warga dan Dasbor Administrasi Desa Siwalan berbasis Laravel.

---

## 🚀 Fitur Utama

- **Layanan Mandiri Warga**:
  - Pengajuan **SKTM** (Surat Keterangan Tidak Mampu)
  - Pengajuan **Surat Kehilangan**
  - Pengajuan **Surat Keterangan Domisili**
  - Cek Status Pengajuan Layanan secara real-time
- **Notifikasi WhatsApp Otomatis (Integrasi Fonnte)**:
  - Notifikasi rincian lengkap pengajuan ke warga pengaju (User) & Admin saat pengajuan dikirim.
  - Notifikasi status persetujuan (Diterima/Ditolak) beserta alasan penolakan langsung ke WhatsApp warga.
- **Dasbor Admin**:
  - Manajemen Berita & Artikel.
  - Verifikasi Berkas & Pengajuan Surat Warga.
  - Pengaturan Integrasi WhatsApp (Token & Nomor Admin Fonnte).
  - Cetak Surat Resmi (PDF) langsung dari dasbor untuk pengajuan yang telah diterima.

---

## 🛠️ Panduan Instalasi & Pengoperasian

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di perangkat lokal Anda.

### 1. Clone Repository
Clone proyek ini ke folder lokal Anda:
```bash
git clone <repository-url>
cd web-desa-siwalan
```

### 2. Instalasi Dependensi PHP & JavaScript
Jalankan perintah berikut untuk menginstal dependensi PHP (Composer) dan Javascript (NPM):
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (`.env`)
Salin berkas konfigurasi `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` baru tersebut, lalu sesuaikan bagian konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306        # Ubah port jika menggunakan MAMP (misal: 8889) atau XAMPP
DB_DATABASE=db-web-desa-siwalan
DB_USERNAME=root
DB_PASSWORD=root    # Masukkan password database Anda (jika ada)
```

### 4. Generate Application Key
Jelaskan kunci aplikasi Laravel Anda menggunakan perintah:
```bash
php artisan key:generate
```

### 5. Migrasi Database & Seeder
Buat database baru di MySQL dengan nama `db-web-desa-siwalan`, lalu jalankan migrasi beserta seeder untuk mengisi data awal (akun Admin):
```bash
php artisan migrate --seed
```

> **🔑 Kredensial Login Admin Default:**
> - **Email:** `admin@gmail.com`
> - **Password:** `password`

### 6. Hubungkan Storage Link
Buat tautan simbolis (*symbolic link*) untuk folder penyimpanan berkas unggahan warga (KTP, KK, Surat Pengantar):
```bash
php artisan storage:link
```

### 7. Jalankan Server Lokal
Jalankan server pengembangan lokal beserta Vite untuk aset frontend:

```bash
# Untuk menjalankan server Laravel & Vite sekaligus (sesuai script package.json)
composer run dev
```
Atau secara terpisah:
```bash
# Tab terminal 1
php artisan serve

# Tab terminal 2
npm run dev
```

Buka browser Anda di alamat `http://127.0.0.1:8000` untuk melihat website.

---

## 🧪 Pengujian Sistem (Testing)

Proyek ini dilengkapi dengan skenario pengujian unit/fitur lengkap (**Whitebox Testing**) menggunakan SQLite in-memory database (tidak mengganggu database MySQL utama Anda).

### Menjalankan Semua Pengujian sekaligus:
```bash
php artisan test
```

### Menjalankan Pengujian per Berkas / Fitur secara spesifik:

- **Pengujian Fitur Login (Auth)**:
  ```bash
  php artisan test tests/Feature/Auth/LoginTest.php
  ```
- **Pengujian Layanan SKTM**:
  ```bash
  php artisan test tests/Feature/Layanan/SktmTest.php
  ```
- **Pengujian Layanan Surat Kehilangan**:
  ```bash
  php artisan test tests/Feature/Layanan/SuratKehilanganTest.php
  ```
- **Pengujian Layanan Surat Keterangan Domisili**:
  ```bash
  php artisan test tests/Feature/Layanan/SuratKeteranganDomisiliTest.php
  ```
- **Pengujian Fitur Pengaduan**:
  ```bash
  php artisan test tests/Feature/Pengaduan/PengaduanTest.php
  ```
- **Pengujian Kelola Berita / Artikel (Posts)**:
  ```bash
  php artisan test tests/Feature/Posts/PostsTest.php
  ```

