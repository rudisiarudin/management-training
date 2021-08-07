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

<div style="margin: 15px 0px; text-align: center">
    <h3 style="margin-bottom: 5px"><u>SURAT KETERANGAN</u></h3>
    <h3 style="margin: 0">{{ $letterNumber }}</h3>
</div>

<div style="margin: 15px 0px; text-align: justify; line-height: 0.7cm">
    <p>
        PT. Trainers Management Indonesia, Perusahaan Jasa Pembinaan Keselamatan dan Kesehatan Kerja (PJK3) yang ditunjuk oleh
        Kementerian Ketenagakerjaan RI dengan Nomor.5/675/AS.02.04/VII/2020 menerangkan bahwa nama dibawah ini:
    </p>
</div>

<div style="margin: 15px 0px">
    <table width="100%">
        <tr>
            <td width="20%">Nama</td>
            <td>: {{ $participant->name }}</td>
        </tr>
        <tr>
            <td width="20%">Perusahaan</td>
            <td> : {{ $participant->companies->name ? $participant->companies->name : ($participant->raw_company ?: 'Individu') }}</td>
        </tr>
    </table>
</div>

<div style="margin: 15px 0px; text-align: center; line-height: 0.7cm">
    <p>
        TELAH MENGIKUTI
    </p>

    <h3>
        "PEMBINAAN {{ strtoupper( $trainingSchedule->training->name) }} <br>
        SERTIFIKASI KEMENTRIAN KETENAGAKERJAAN RI"
    </h3>

    <p>
        Diselenggarakan oleh <em>Training Center</em> PT. Trainers Management Indonesia <br>
        pada hari/tanggal {{  \Carbon\Carbon::parse($trainingSchedule->schedule_date)->locale('id_ID')->isoFormat('dddd, D MMMM Y')  }}
    </p>
</div>

<div style="margin: 15px 0px; text-align: justify; line-height: 0.7cm">
    <p>
        Sementara Sertifikat dan Lisensi sedang dalam proses penerbitan oleh Kementerian Ketenagakerjaan Republik Indonesia,
        Surat keterangan ini berlaku selama 90 (sembilan puluh) hari kerja.
    </p>

    <p>
        Demikian surat keterangan ini dikeluarkan dan ditandatangani agar dipergunakan sebaik-baiknya.
    </p>
</div>

<div  style="margin: 25px 0px; text-align: right">
    <p>
        Jakarta , {{  \Carbon\Carbon::now()->locale('id_ID')->isoFormat('D MMMM Y')  }}
    </p>

    <br><br>

    <p style="margin: 5px"><strong><u>Henny Budi Hastuti</u></strong></p>
    <small><strong>Direktur</strong></small>
</div>

</body>
</html>
