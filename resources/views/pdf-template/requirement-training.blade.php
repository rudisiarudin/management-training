<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img {
            width: 50%;
        }
    </style>
</head>
<body>
    @foreach($trainingSchedule->registrations as $key => $item)
        <div style="padding: 50px 30px; width: 100%; page-break-after: always">
            <h3>Dokumen Persyaratan {{ $item->participant->name }} - {{ $item->participant->companies->name }}</h3>

            <img src="{{ asset($item->participant->ktp) }}">
            <img src="{{ asset($item->participant->ijazah) }}">
            <img src="{{ asset($item->participant->surat_pengantar) }}">
        </div>
    @endforeach
</body>
</html>
