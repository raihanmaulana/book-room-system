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
    <h3>DEPARTEMEN TEKNIK INDUSTRI</h3>
    <h3>UNIVERSITAS DIPONEGORO</h3>
    <p>Jl. Prof. Jacub Rais, Tembalang, Semarang, Jawa Tengah</p>
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