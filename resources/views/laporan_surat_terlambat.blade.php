<!-- resources/views/laporan_surat_terlambat.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Terlambat</title>
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
    <h1>Laporan Surat Terlambat</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alasan</th>
                <th>Tanggal dan Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataList as $data)
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['reason'] }}</td>
                    <td>{{ $data['date_time'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
