<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Pengantar Kehilangan</title>
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

        /* ==== TTD 2 KOLOM (PEMOHON KIRI, KADES KANAN) ==== */
        .ttd-wrap {
            margin-top: 35px;
            width: 100%;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .ttd-col {
            width: 50%;
            vertical-align: top;
            text-align: center;
        }

        /* area tanda tangan dibuat sama tinggi */
        .ttd-box {
            position: relative;
            height: 150px;
        }

        .ttd-top {
            margin: 0;
            line-height: 1.3;
        }

        /* nama dipaksa berada di garis bawah yang sama */
        .ttd-name {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            margin: 0;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- ==== KOP SURAT ==== -->
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
                        : Jalan Jawa No. 48 <u>Telp. (0352)</u> 312356 Kode Pos 63472
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
        <h4>SURAT PENGANTAR KEHILANGAN</h4>
        <p>Nomor : . . . / . . / . .  . . . . . . . . . . / . . . . </p>
    </div>

    <!-- ISI SURAT -->
    <div class="isi-surat">
        <p>
            Yang bertanda Tangan dibawah ini Kepala Desa Siwalan Kecamatan Mlarak Kabupaten Ponorogo
            Menerangkan <u>bahwa</u> :
        </p>
    </div>

    <!-- DATA PEMOHON -->
    <div class="data-pemohon">
        <table>
            <tr>
                <td>Nama</td><td>:</td><td><strong>{{ strtoupper($suratKehilangan->nama) }}</strong></td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir</td><td>:</td>
                <td>{{ $suratKehilangan->tempat_lahir }},{{ \Carbon\Carbon::parse($suratKehilangan->ttl)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>N I K</td><td>:</td><td>{{ $suratKehilangan->nik }}</td>
            </tr>
            @if ($suratKehilangan->kewarganegaraan)
            <tr>
                <td>Kewarganegaraan</td><td>:</td><td>{{ $suratKehilangan->kewarganegaraan }}</td>
            </tr>
            @endif
            @if ($suratKehilangan->agama)
            <tr>
                <td>A g a m a</td><td>:</td><td>{{ $suratKehilangan->agama }}</td>
            </tr>
            @endif
            @if ($suratKehilangan->pekerjaan)
            <tr>
                <td>Pekerjaan</td><td>:</td><td>{{ $suratKehilangan->pekerjaan }}</td>
            </tr>
            @endif
            @if ($suratKehilangan->status_perkawinan)
            <tr>
                <td>Status Perkawinan</td><td>:</td><td>{{ $suratKehilangan->status_perkawinan }}</td>
            </tr>
            @endif
            <tr>
                <td>A l a m a t</td><td>:</td><td>{{ $suratKehilangan->alamat }}</td>
            </tr>
            <tr>
                <td>Keterangan</td><td>:</td>
                <td>
                    Orang tersebut benar-benar penduduk Desa Siwalan Kecamatan Mlarak Kabupaten Ponorogo
                    dan menerangkan bahwa yang bersangkutan telah kehilangan
                    <strong>{{ $suratKehilangan->barang_hilang }}</strong> atas Nama
                    <strong>{{ strtoupper($suratKehilangan->nama) }}</strong> dengan NIK
                    <strong>{{ $suratKehilangan->nik }}</strong>,<br>
                    Barang <u>tersebut  hilang</u> pada hari
                    <strong>{{ \Carbon\Carbon::parse($suratKehilangan->tanggal_hilang)->isoFormat('dddd') }}</strong>  tanggal
                    <strong>{{ \Carbon\Carbon::parse($suratKehilangan->tanggal_hilang)->isoFormat('D MMMM Y') }}</strong>
                    @if($suratKehilangan->tempat_hilang). <u>Hilang  di</u> {{ $suratKehilangan->tempat_hilang }} @endif
                    @if($suratKehilangan->waktu_hilang) kejadian Pukul.{{ $suratKehilangan->waktu_hilang }}@endif
                </td>
            </tr>
        </table>
    </div>

    <!-- PENUTUP -->
    <div class="isi-surat">
        <p style="margin-top:15px;">
            Selanjutnya Surat Keterangan ini diberikan kepada yang bersangkutan untuk mencari
            Surat Kehilangan di POLSEK MLARAK.
        </p>
        <p style="margin-top:8px;">
            Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <!-- TANDA TANGAN (PEMOHON KIRI, KADES KANAN) -->
    <div class="ttd-wrap">
        <table class="ttd-table">
            <tr>
                <td class="ttd-col">
                    <div class="ttd-box">
                        <p class="ttd-top"><strong>Pemohon</strong></p>
                        <p class="ttd-name">{{ strtoupper($suratKehilangan->nama) }}</p>
                    </div>
                </td>

                <td class="ttd-col">
                    <div class="ttd-box">
                        <p class="ttd-top"><strong>Siwalan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</strong></p>
                        <p class="ttd-top">Kepala Desa Siwalan</p>
                        <p class="ttd-name">NOVY DWI HERMAWATI, S.Pd, M.MPd</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
