<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        @page { margin: 1.5cm 2cm 1.5cm 2cm; }

        body{
            font-family:"Times New Roman", Times, serif;
            font-size:12pt;
            line-height:1.4;
            color:#000;
        }

        /* ==== KOP (TABLE, AMAN UNTUK DOMPDF) ==== */
        .kop-wrap{ width:100%; margin:0 0 12px 0; }

        .kop-table{
            width:100%;
            border-collapse:collapse;
        }

        .kop-table td{ vertical-align:top; }

        .kop-logo-td{
            width:120px;
            padding:0;
        }

        .kop-logo{
            width:95px;
            height:auto;
            margin-top:0px;
        }

        .kop-text-td{
            text-align:center;
            padding:0;
        }

        .kop-h1{
            margin:0;
            font-size:18pt;
            font-weight:bold;
            text-transform:uppercase;
            line-height:1.15;
        }

        .kop-h2{
            margin:2px 0 0 0;
            font-size:16pt;
            font-weight:bold;
            text-transform:uppercase;
            line-height:1.15;
        }

        .kop-h3{
            margin:4px 0 0 0;
            font-size:18pt;
            font-weight:bold;
            text-transform:uppercase;
            line-height:1.15;
        }

        .kop-alamat{
            margin:6px 0 0 0;
            font-size:12pt;
            line-height:1.2;
        }

        .kop-siwalan{
            margin:8px 0 0 0;
            font-size:22pt;
            font-weight:bold;
            letter-spacing:10px;
            line-height:1;
        }

        .line-1{ border-top:3px solid #000; margin-top:10px; }
        .line-2{ border-top:1px solid #000; margin-top:3px; }

        /* ==== ISI SURAT ==== */
        .nomor-surat{ text-align:center; margin:15px 0 20px 0; }
        .nomor-surat h4{
            margin:0;
            font-size:12pt;
            font-weight:bold;
            text-decoration:underline;
        }

        .isi-surat{ text-align:justify; margin:10px 0; }
        .isi-surat p{ text-indent:50px; margin:6px 0; }

        .data-pemohon{ margin-left:80px; margin-top:8px; margin-bottom:8px; }
        .data-pemohon table{ width:100%; border-collapse:collapse; }
        .data-pemohon td{ padding:2px 0; vertical-align:top; }
        .data-pemohon td:first-child{ width:160px; }
        .data-pemohon td:nth-child(2){ width:15px; }

        /* ==== TTD (DIPERBAIKI BIAR RAPI) ==== */
        .ttd{
            margin-top:35px;
            text-align:right;
            margin-right:50px;
        }

        .ttd p{ margin:3px 0; }

        .ttd .jabatan{ margin-top:8px; }

        .ttd .ttd-space{
            height:70px; /* ruang tanda tangan yang stabil */
        }

        .ttd .nama-pejabat{
            font-weight:bold;
            text-decoration:underline;
            margin:0;
        }
    </style>
</head>

<body>
    <!-- ==== KOP SURAT (FIX, TIDAK AMBIL DB) ==== -->
    <div class="kop-wrap">
        <table class="kop-table">
            <tr>
                <td class="kop-logo-td">
                    <img src="file://{{ public_path('images/ha.jpg') }}" class="kop-logo" alt="Logo">
                </td>
                <td class="kop-text-td">
                    <div class="kop-h1">PEMERINTAH KABUPATEN PONOROGO</div>
                    <div class="kop-h2">KECAMATAN MLARAK</div>
                    <div class="kop-h3">KANTOR DESA SIWALAN</div>

                    <div class="kop-alamat">
                        <span style="text-decoration:underline; font-weight:bold;">Alamat</span>
                        : Jl. Jawa No. 48 Telp. (0352) 312356 Kode Pos 64372
                    </div>

                    <div class="kop-siwalan">SIWALAN</div>
                </td>
            </tr>
        </table>

        <div class="line-1"></div>
        <div class="line-2"></div>
    </div>

    <!-- NOMOR SURAT -->
    <div class="nomor-surat">
        <h4>SURAT KETERANGAN TIDAK MAMPU</h4>
        <p>Nomor: . . . / . . / . .  . . . . . . . . . . / . . . . </p>
    </div>

    <!-- ISI SURAT -->
    <div class="isi-surat">
        <p>
            Yang bertanda tangan di bawah ini Kepala Desa Siwalan, Kecamatan Mlarak, Kabupaten Ponorogo,
            dengan ini menerangkan bahwa:
        </p>
    </div>

    <!-- DATA PEMOHON -->
    <div class="data-pemohon">
        <table>
            <tr>
                <td>Nama</td><td>:</td><td><strong>{{ strtoupper($sktm->nama) }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td><td>:</td><td>{{ $sktm->nik }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td><td>:</td>
                <td>{{ $sktm->tempat_lahir }}, {{ \Carbon\Carbon::parse($sktm->ttl)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td><td>:</td><td>{{ $sktm->status_perkawinan }}</td>
            </tr>
            <tr>
                <td>Alamat</td><td>:</td><td>{{ $sktm->alamat }}</td>
            </tr>
            @if ($sktm->nama_anak)
                <tr>
                    <td>Nama Anak</td><td>:</td><td>{{ $sktm->nama_anak }}</td>
                </tr>
            @endif
            <tr>
                <td>Keperluan</td><td>:</td><td><strong>{{ $sktm->keperluan }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- PENUTUP -->
    <div class="isi-surat">
        <p>
            Adalah benar warga tersebut di atas berdomisili di Desa Siwalan dan termasuk dalam kategori keluarga tidak
            mampu secara ekonomi.
        </p>
        <p style="margin-top:8px;">
            Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <!-- TANDA TANGAN -->
    <div class="ttd">
        <p>Siwalan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p class="jabatan">Kepala Desa Siwalan</p>

        <div class="ttd-space"></div>

        <p class="nama-pejabat">NOVY DWI HERMAWATI, S.Pd, M.MPd</p>
    </div>
</body>
</html>
