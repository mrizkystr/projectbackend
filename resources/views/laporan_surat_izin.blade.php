<!-- resources/views/laporan_surat_izin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Izin</title>
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
    <h1>Laporan Surat Izin</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Izin</th>
                <th>Alasan</th>
                <th>Tanggal Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataList as $data)
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['class'] }}</td>
                    <td>{{ $data['departement'] }}</td>
                    <td>{{ $data['permission'] }}</td>
                    <td>{{ $data['reason'] }}</td>
                    <td>{{ $data['date_submission'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
