<!-- resources/views/laporan_absensi_mapel.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Mapel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Absensi Mapel</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Departemen</th>
                <th>Kehadiran</th>
                <th>Mapel</th>
                <th>Alasan</th>
                <th>Tanggal dan Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataList as $data)
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['class'] }}</td>
                    <td>{{ $data['departement'] }}</td>
                    <td>{{ $data['attendance'] }}</td>
                    <td>{{ $data['mapel'] }}</td>
                    <td>{{ $data['reason'] }}</td>
                    <td>{{ $data['date_time'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
