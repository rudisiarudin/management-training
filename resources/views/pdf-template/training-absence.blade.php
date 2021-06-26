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
    <h3>Form Absensi Kehadiran Peserta <br> Pelatihan dan Pembinaan Sertifikasi {{ $trainingSchedule->training->name }}</h3>
</div>

<div style="margin: 15px 0px; text-align: center">
    <table class="table" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <td align="center" width="10px">No.</td>
            <td align="center">Nama</td>
            <td align="center">Perusahaan</td>
            <td align="center">TTD</td>
        </tr>
        @foreach($trainingSchedule->registrations as $key => $item)
            <tr>
                <td align="center" height="35px">{{ ++$key }}</td>
                <td>{{ $item->participant->name  }}</td>
                <td>{{ $item->participant->companies->name  }}</td>
                <td></td>
            </tr>
        @endforeach
    </table>
</div>

<div  style="margin: 25px 0px; text-align: right">
    <p>
        ...................... , &nbsp; ..... &nbsp; {{ \Carbon\Carbon::parse($trainingSchedule->schedule_date)->format('F Y') }}
    </p>

    <br><br>

    <p>...................................</p>
</div>

</body>
</html>
