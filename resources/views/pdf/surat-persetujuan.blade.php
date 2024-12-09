<!DOCTYPE html>
<html>
<head>
    <title>Surat Persetujuan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kop-surat {
            text-align: center;
        }

       
    </style>
</head>
<body>
    <div class="kop-surat">
    <h2 style="margin: 0px;">DEPARTEMEN TEKNIK INDUSTRI</h2>
    <h2 style="margin: 0px;">UNIVERSITAS DIPONEGORO</h2>
    <p style="font-size: 10px; margin:5px;">Jl. Prof. Jacub Rais, Tembalang, Semarang, Jawa Tengah <br> Telp. (024) 7460052 | Email industri@ft.undip.ac.id</p>
    </div>
    <hr>
    <p>Semarang, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    <p>Nomor: 123/DI/TU/XII/2024</p>
    <p>Hal: Persetujuan Peminjaman Ruangan</p>
    <p>Lampiran: -</p>
    <br>
    <p>Yth. {{ $penyelenggara }}</p>
    <p>di tempat</p>
    <br>
    <p>Dengan hormat,</p>
    <p>Berdasarkan permohonan yang diajukan pada tanggal {{ $tanggal }}, dengan ini kami menyampaikan bahwa permohonan tersebut telah disetujui.</p>
    <p>Detail peminjaman adalah sebagai berikut:</p>
    <ul>
        <li>Ruangan: {{ $ruangan }}</li>
        <li>Tanggal: {{ $tanggal }}</li>
        <li>Waktu: {{ $waktu }}</li>
        <li>Keperluan: {{ $deskripsi }}</li>
    </ul>
    <p>Kami berharap Saudara dapat menjaga kebersihan, ketertiban, dan keamanan ruangan selama kegiatan berlangsung.</p>
    <p>Demikian surat ini kami sampaikan. Terima kasih atas perhatian dan kerjasama Saudara.</p>
    <br>
    <p>Ketua Departemen Teknik Industri</p>
    <p>Fakultas Teknik Universitas Diponegoro</p>
    <br><br>
    <p>Dr. Singgih Saptadi, S.T., M.T.</p>
    <p>NIP. 197403162001121001</p>
</body>
</html>