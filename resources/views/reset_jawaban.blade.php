<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Jawaban</title>
</head>
<body>
    
    <table border=1 cellpadding="10px">
    <tr>
        <th>Nama</th>
        <th>Mapel</th>
        <th>Aksi</th>
    </tr>
    @foreach($jawaban as $data)
        <tr>
            <td>{{ $data->name }}</td>
            <td>{{ $data->mapel }}</td>
            <td><a href="{{route ('resetdelete', $data->id_participant) }}">Hapus</a></td>
        </tr>
    @endforeach
    </table>
</body>
</html>