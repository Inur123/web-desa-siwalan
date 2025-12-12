<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        @page {
            margin: 1.5cm 2cm 1.5cm 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #000;
        }
        /* Layout Kop Surat Baru */
        .kop-surat {
            position: relative; /* Penting untuk absolute positioning logo */
            width: 100%;
            border-bottom: 5px double #000; /* Garis ganda tebal seperti contoh */
            padding-bottom: 8px;
            margin-bottom: 20px;
            min-height: 100px;
        }
        .kop-logo {
            position: absolute; /* Logo mengambang di kiri */
            left: 0;
            top: 5px;
            width: 90px;
        }
        .kop-logo img {
            width: 90px;
            height: auto;
            object-fit: contain;
        }
        .kop-text {
            width: 100%;
            text-align: center; /* Teks benar-benar center di halaman */
            padding-left: 0;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.1;
        }
        .kop-surat h3 {
            margin: 5px 0;
            font-size: 18pt; /* Nama Desa lebih besar */
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .kop-surat p {
            margin: 0;
            font-size: 10pt;
            font-style: italic; /* Alamat miring */
            line-height: 1.2;
        }

        .nomor-surat {
            text-align: center;
            margin: 20px 0;
        }
        .nomor-surat h4 {
            margin: 3px 0;
            font-size: 11pt;
            text-decoration: underline;
            font-weight: bold;
        }
        .nomor-surat p {
            margin: 3px 0;
            font-size: 10pt;
        }
        .isi-surat {
            text-align: justify;
            margin: 10px 0;
        }
        .isi-surat p {
            text-indent: 50px;
            margin: 6px 0;
        }
        .data-pemohon {
            margin-left: 80px;
            margin-top: 8px;
            margin-bottom: 8px;
        }
        .data-pemohon table {
            width: 100%;
        }
        .data-pemohon td {
            padding: 2px 0;
            vertical-align: top;
        }
        .data-pemohon td:first-child {
            width: 160px;
        }
        .data-pemohon td:nth-child(2) {
            width: 15px;
        }
        .ttd {
            margin-top: 20px;
            text-align: right;
            margin-right: 50px;
        }
        .ttd p {
            margin: 3px 0;
        }
        .ttd .nama-pejabat {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- KOP SURAT -->
    <div class="kop-surat">
        @if($settings['logo_kop_surat'] ?? null)
        <div class="kop-logo">
            <img src="{{ public_path('storage/' . $settings['logo_kop_surat']) }}" alt="Logo">
        </div>
        @endif
        <div class="kop-text">
            <h2>{{ strtoupper($settings['kop_surat_kabupaten'] ?? 'PEMERINTAH KABUPATEN MAGETAN') }}</h2>
            <h2>{{ strtoupper($settings['kop_surat_kecamatan'] ?? 'KECAMATAN PANEKAN') }}</h2>
            <h3>{{ strtoupper($settings['kop_surat_desa'] ?? 'DESA SIWALAN') }}</h3>
            <p>{{ $settings['kop_surat_alamat'] ?? 'Jl. Raya Siwalan No. 01, Kode Pos 63396' }}</p>
            <p>{{ $settings['kop_surat_kontak'] ?? 'Email: desasiwalan@magetan.go.id | Telp: (0351) 123456' }}</p>
        </div>
    </div>

    <!-- NOMOR SURAT -->
    <div class="nomor-surat">
        <h4>SURAT KETERANGAN TIDAK MAMPU</h4>
        <p>Nomor: {{ $nomorSurat }}</p>
    </div>

    <!-- ISI SURAT -->
    <div class="isi-surat">
        <p>
            Yang bertanda tangan di bawah ini Kepala Desa Siwalan, Kecamatan Panekan, Kabupaten Magetan,
            dengan ini menerangkan bahwa:
        </p>
    </div>

    <!-- DATA PEMOHON -->
    <div class="data-pemohon">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ strtoupper($sktm->nama) }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $sktm->nik }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $sktm->tempat_lahir }}, {{ \Carbon\Carbon::parse($sktm->ttl)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $sktm->status_perkawinan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $sktm->alamat }}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td>{{ $sktm->no_hp }}</td>
            </tr>
            @if($sktm->nama_anak)
            <tr>
                <td>Nama Anak</td>
                <td>:</td>
                <td>{{ $sktm->nama_anak }}</td>
            </tr>
            @endif
            <tr>
                <td>Keperluan</td>
                <td>:</td>
                <td><strong>{{ $sktm->keperluan }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- PENUTUP -->
    <div class="isi-surat">
        <p>
            Adalah benar warga tersebut di atas berdomisili di Desa Siwalan dan termasuk dalam kategori keluarga tidak mampu secara ekonomi.
        </p>
        <p style="margin-top: 8px;">
            Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <!-- TANDA TANGAN -->
    <div class="ttd">
        <p>Siwalan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Kepala Desa Siwalan</p>
        <p class="nama-pejabat">{{ strtoupper($settings['nama_kepala_desa'] ?? 'NAMA KEPALA DESA') }}</p>
        <p>NIP. {{ $settings['nip_kepala_desa'] ?? '19xxxxxxxxxxxxxxx' }}</p>
    </div>
</body>
</html>
