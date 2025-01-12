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
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .content {
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .left {
            display: flex;
            align-items: center;
        }
        .header .left h2 {
            margin: 0;
        }
        .header .right {
            color: #1e40af;
            font-size: 1.2rem;
        }
        hr {
            border: none;
            border-top: 1px dashed #ddd;
            margin: 20px 0;
        }
        .school-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .school-details {
            font-size: 0.9rem;
        }
        .school-details .code {
            color: #999;
        }
        .school-details .name {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .school-details .location {
            font-size: 0.9rem;
            color: #555;
        }
        .details, .participant, .dates {
            margin-bottom: 15px;
        }
        .details div, .participant div, .dates div {
            margin-bottom: 10px;
        }
        .details span, .participant span, .dates span {
            font-weight: bold;
        }
        .details div, .level div, .participant div, .registration-date div, .status div, .verification-date div {
            font-size: 1rem;
        }
        .registration-code {
            text-align: center;
            margin-top: 20px;
        }
        .registration-code h6 {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="header">
            <div class="left">
                <h2>Highlandtion</h2>
            </div>
            <div class="right">2.1</div>
        </div>
        <hr>
        <div class="school-info">
            <div class="school-details">
                <div class="code">HL 2.1</div>
                <div class="name">SMAN 1 LANDBOUW</div>
                <div class="location">Bukittinggi</div>
            </div>
        </div>
        <hr>
        <div class="details">
            <div class="ticket">
                <span>Tiket</span>
                <div>{{ $registrasi->menu->mata_pelajaran }}</div>
            </div>
            <div class="level">
                <span>Tingkat</span>
                <div>{{ $registrasi->menu->tingkat }}</div>
            </div>
        </div>
        <div class="participant">
            <div class="name">
                <span>Nama Peserta</span>
                <div>{{ $registrasi->nama }}</div>
            </div>
            <div class="school">
                <span>Sekolah Asal</span>
                <div>{{ $registrasi->asal_sekolah }}</div>
            </div>
        </div>
        <hr>
        <div class="dates">
            <div class="registration-date">
                <span>Tanggal Pendaftaran</span>
                <div>{{ $registrasi->created_at }}</div>
            </div>
            <div class="status">
                <span>Status</span>
                <div>{{ $registrasi->status }}</div>
            </div>
            <div class="verification-date">
                <span>Tanggal Diverivikasi</span>
                <div>{{ $registrasi->updated_at }}</div>
            </div>
        </div>
        <div class="registration-code">
            <span>Nomor Registrasi</span>
            <h6>{{ $registrasi->registration_code }}</h6>
        </div>
    </div>
</div>
</body>
</html>
