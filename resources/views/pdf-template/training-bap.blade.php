<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table td, .table th {
            border: 1px solid black;
        }

        .footer {
            text-align: center;
            position: fixed;
            bottom: 40px;
            color: #a9aab1;
        }
    </style>
</head>
<body>
    <div class="footer">
        <p>
            Jalan Kenari Raya Ruko Delta Silikon VI Blok B-12, Kec.Cikarang Pusat, <br> Bekasi – Jawa Barat 17530
        </p>
    </div>

    <div style="text-align: center; line-height: 1.6">
        <h2 style="margin-bottom: 0">PJK3 PT. TRAINERS MANAGEMENT INDONESIA</h2>
        <strong>Nomor 5/843/AS.02.01/X/2020</strong><br>
        Jl. Kenari Raya Blok B-12 (Delta Silicon VI) Kec. Cikarang Pusat, Bekasi &ndash; Jawa Barat, 17530<br>
        <strong>Telp. 021-8991-6788 / 2215-6402 | Email : <a href="mailto:tmi.update@gmail.com">tmi.update@gmail.com</a></strong>
    </div>
    <hr>

    <div style="margin: 15px 0px">
        <table>
            <tr>
                <td>Nomor BAP</td>
                <td>: {{ $bapNumber }}</td>
            </tr>
            <tr>
                <td>Jenis Pembinaan</td>
                <td> : {{ $trainingSchedule->training->name }}</td>
            </tr>
        </table>
    </div>

    <div style="text-align: center; margin: 15px 0; line-height: 1.6">
        <h3>
            <strong>BERITA ACARA</strong><br>
            <strong>PEMBINAAN DAN SERTIFIKASI {{ strtoupper($trainingSchedule->training->name) }}</strong>
        </h3>

        <p style="text-align: justify">
            Telah dilaksanakan Pembinaan Sertifikasi Pembinaan {{ $trainingSchedule->training->name }} yang telah dilaksanakan oleh PJK3 PT.
            TRAINERS MANAGEMENT INDONESIA, secara *<strong>Klasikal/Blanded/Virtual</strong>
            Training sejumlah 20 peserta, daftar peserta terlampir. <br>
            <small style="color: #a9aab1">*Coret yang tidak perlu</small> <br><br>

            Demikianlah Berita Acara ini dibuat dengan sebenar-benarnya dan ditandatangani pada {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
            oleh pihak-pihak tersebut di bawah ini :
        </p>
    </div>

    <br>
    <div style="width: 95%; text-align: center">
        <table class="table" cellspacing="0" cellpadding="10" style="table-layout: auto; width: 100%">
            <tr>
                <th style="width: 10px;" align="center">NO.</th>
                <th style="width: 70px">UNSUR PELAKSANA</th>
                <th>NAMA LENGKAP</th>
                <th>TANDA TANGAN</th>
            </tr>
            <tr>
                <td align="center">1</td>
                <td style="height: 40px">MENGETAHUI</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">2</td>
                <td style="height: 40px">INSTRUKTUR</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center">3</td>
                <td>
                    PENYELENGGARA <br>
                    PT. TRAINERS MANAGEMENT INDONESIA
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div style="page-break-before: always">
        <p><strong><u>Nomor SKP </u></strong></p>

        <p><strong>Bidang Ahli K3 Umum dan SMK3: </strong></p>
        <p><strong>Nomor 5/675/AS.02.04/VII/2020</strong></p><br>

        <p><strong>Bidang Ahli K3 Listrik dan Teknisi K3 Listrik :</strong></p>
        <p><strong>Nomor 5/843/AS.02.01/X/2020</strong></p><br>

        <p><strong>Bidang Konstruksi ( Perancah ):</strong></p>
        <p><strong>Nomor 5/891/AS.02.01/VIII/2019</strong></p><br>

        <p><strong>Bidang Pesawat Tenaga Produksi ( Genset) :</strong></p>
        <p><strong>Nomor 5/733/AS.02.00/VIII/2020</strong></p><br>

        <p><strong>Bidang Lingkungan Kerja dan Bahan Berbahaya ( Confined Space Utama dan Madya) :</strong></p>
        <p><strong>Nomor 5/661/AS.03.00/VII/2020</strong></p><br>

        <p><strong>Bidang Kebakaran ( Kebakaran Level D &ndash; A ) :</strong></p>
        <p><strong>Nomor 5/725/AS.02.01/VIII/2020</strong></p><br>

        <p><strong>Bidang Pesawat Angkat dan Angkut ( Forklift, Crane, Buldozer, dll)</strong></p>
        <p><strong>Nomor 5/732/AS.02.00/VIII/2020</strong></p><br>

        <p><strong>Bidang Ketinggian (TKBT dan TKPK)</strong></p>
        <p><strong>Nomor 5.660/AS.03.00/VII/2020</strong></p><br>

        <p><strong>Bidang Kesehatan Kerja (Petugas P3K) :</strong></p>
        <p><strong>Nomor 5/760/AS.02.02/VIII/2020</strong></p>
    </div>
</body>
</html>
