<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        tr, td, th {
            background-color: #0f6848;
        }
    </style>
</head>
<body>
<table style="width: 100%" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Company</th>
        <th>Training</th>
        <th>Location</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trainingSchedule->registrations as $key => $item)
        <tr>
            <td>{{ $item->participant->name }}</td>
            <td>{{ $item->participant->address }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->participant->companies->name }}</td>
            <td>{{ $trainingSchedule->training->name }}</td>
            <td>{{ $trainingSchedule->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
