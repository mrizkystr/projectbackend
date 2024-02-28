<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin</title>
</head>
<body>
    <p>Kepada Yth.,</p>

    <p>Kepala Sekolah<br>
    SMA ABC<br>
    Jl. Contoh No. 123<br>
    Kota Contoh</p>

    <p>Kota Contoh, {{ date('j F Y') }}</p>

    <p><strong>Perihal:</strong> Permohonan Izin</p>

    <p>Dengan hormat,</p>

    <p>Saya yang bertanda tangan di bawah ini:</p>

    <p><strong>Nama:</strong> Ahmad Syahid<br>
    <strong>Kelas:</strong> XII IPA 1<br>
    <strong>Jurusan:</strong> IPA</p>

    <p>Dengan ini bermaksud untuk mengajukan permohonan izin dengan rincian sebagai berikut:</p>

    <ul>
        <li><strong>Jenis Izin:</strong> Izin Tidak Masuk Sekolah</li>
        <li><strong>Alasan:</strong> Sakit</li>
        <li><strong>Tanggal Pengajuan:</strong> {{ date('j F Y') }}</li>
    </ul>

    <p>Demikian surat ini saya buat dengan sebenarnya. Atas perhatian dan izin yang diberikan, saya ucapkan terima kasih.</p>

    <p>Hormat saya,</p>

    <p>Ahmad Syahid</p>

    <p>[Tanda Tangan Anda]</p>
</body>
</html>
