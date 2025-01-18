<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 105mm;
            height: 148.5mm;
            padding: 10mm;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 2px dashed #000; /* Outline putus-putus */
        }

        .container-2 {
            width: 165mm;
            height: 190mm;
            padding: 10mm;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            border: 2px dashed #000; /* Outline putus-putus */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            color: #000000; /* Teks header putih agar kontras dengan latar belakang */
        }
        .header .left h2 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .header .right {
            font-size: 1rem;
            color: #000000;
        }
        hr {
            border: none;
            border-top: 1px dashed #000000;
            margin: 10px 0;
        }
        .school-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #000000; /* Teks info sekolah putih agar kontras */
        }
        .school-details {
            font-size: 0.9rem;
        }
        .school-details .code {
            color: #000000;
        }
        .school-details .name {
            font-weight: bold;
            font-size: 1.1rem;
        }
        .school-details .location {
            font-size: 0.9rem;
        }
        .details, .participant, .dates {
            margin-bottom: 10px;
            color: #000000; /* Teks detail putih agar kontras */
        }
        .details span, .participant span, .dates span {
            font-weight: bold;
        }
        .details div, .participant div, .dates div {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .registration-code {
            text-align: center;
            margin-top: 10px;
        }
        .registration-code h6 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="left">
                <h2>Highlandtion</h2>
            </div>
            <div class="right">2.1</div>
        </div>
        <hr>
        <div class="school-info">
            <div class="school-details">
                <div class="name">SMAN 1 BUKITTINGGI</div>
                <div class="location">Jl. Syekh Jamil Jambek No.36, Pakan Kurai, Kec. Guguk Panjang, Kota Bukittinggi, Sumatera Barat 26136</div>
            </div>
        </div>
        <hr>
        <div class="participant">
            <div>
                <span>Nama Peserta</span>
                <div>{{ $registrasi->nama }}</div>
            </div>
            <div>
                <span>Sekolah Asal</span>
                <div>{{ $registrasi->asal_sekolah }}</div>
            </div>
        </div>
        <div class="details">
            <div>
                <span>Tiket</span>
                <div>{{ $registrasi->menu->mata_pelajaran }}</div>
            </div>
            <div>
                <span>Tingkat</span>
                <div>{{ $registrasi->menu->tingkat }}</div>
            </div>
            <div>
                <span>Ruang Ujian/Lokasi Acara</span>
                <div>{{ $registrasi->ruangan->nama_ruangan }}</div>
            </div>
        </div>
        <hr>
        <div class="dates">
            <div>
                <span>Waktu Pendaftaran</span>
                <div>{{ $registrasi->created_at }}</div>
            </div>
            <div>
                <span>Waktu Diverifikasi</span>
                <div>{{ $registrasi->updated_at }}</div>
            </div>
        </div>
        <div class="registration-code">
            <span>Nomor Registrasi</span>
            <h6>{{ $registrasi->registration_code }}</h6>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h3 style="text-align: center"><i>Lengkapi Data dan Antarkan Kartu ini Menuju Meja Registrasi Ulang</i></h3>
    <div class="container-2">
        <div class="header">
            <div class="left">
                <h2>Highlandtion</h2>
            </div>
            <div class="right">2.1</div>
        </div>
        <hr>
        <div class="school-info">
            <div class="school-details">
                <div class="name">SMAN 1 BUKITTINGGI</div>
                <div class="location">Jl. Syekh Jamil Jambek No.36, Pakan Kurai, Kec. Guguk Panjang, Kota Bukittinggi, Sumatera Barat 26136</div>
            </div>
        </div>
        <hr>
        <div class="participant">
            <div>
                <span>Nama Peserta</span>
                <div></div>
            </div>
            <br><br>
            <div>
                <span>Sekolah Asal</span>
                <div></div>
            </div>
            <br><br>
        </div>
        <div class="details">
            <div>
                <span>Tiket</span>
                <div></div>
            </div>
            <br><br>
            <div>
                <span>Tingkat</span>
                <div></div>
            </div>
            <br><br>
            <div>
                <span>Ruang Ujian/Lokasi Acara</span>
                <div></div>
            </div>
            <br><br>
        </div>
        <hr>
        <div class="dates">
            <div>
                <span>Waktu Pendaftaran</span>
                <div></div>
                <br><br>
            </div>
            <div>
                <span>Waktu Diverifikasi</span>
                <div></div>
                <br><br>
            </div>
        </div>
        <div class="registration-code">
            <span>Nomor Registrasi</span>
            <h6>HL- . . . . . . . . . . . . . </h6>
        </div>
    </div>
</body>
</html>
