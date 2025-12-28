<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Registrasi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A5 portrait;
            margin: 0;
        }

        body {
            font-family: Helvetica, sans-serif;
            margin: 0;
            padding: 15mm;
            background: #ffffff;
            color: #000000;
            font-size: 12pt;
            line-height: 1.4;
        }

        .header {
            border-bottom: 3px solid #2563eb;
            padding-bottom: 10px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .header-left {
            float: left;
            width: 65%;
        }

        .header-right {
            float: right;
            width: 35%;
            text-align: right;
        }

        .header h2 {
            font-size: 16pt;
            color: #2563eb;
            font-weight: bold;
            margin: 0;
        }

        .badge {
            display: inline-block;
            font-size: 9pt;
            padding: 5px 12px;
            background: #2563eb;
            color: #ffffff;
            border-radius: 15px;
            font-weight: bold;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .school {
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #cccccc;
        }

        .school-name {
            font-size: 14pt;
            font-weight: bold;
            color: #000000;
            margin-bottom: 5px;
        }

        .school-address {
            font-size: 9pt;
            color: #666666;
            line-height: 1.5;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 10pt;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-block {
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .info-label {
            font-size: 8pt;
            color: #666666;
            text-transform: uppercase;
            margin-bottom: 3px;
            font-weight: bold;
        }

        .info-value {
            font-size: 11pt;
            color: #000000;
            font-weight: bold;
            line-height: 1.3;
        }

        .row {
            width: 100%;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .col-half {
            float: left;
            width: 48%;
            margin-right: 4%;
        }

        .col-half:last-child {
            margin-right: 0;
        }

        .reg-box {
            margin-top: 20px;
            padding: 15px;
            background-color: #eff6ff;
            border: 2px solid #2563eb;
            border-radius: 8px;
            text-align: center;
        }

        .reg-label {
            font-size: 9pt;
            color: #666666;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .reg-code {
            font-size: 18pt;
            color: #2563eb;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 0;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #cccccc;
            text-align: center;
            font-size: 8pt;
            color: #999999;
        }

        @media print {
            body {
                padding: 15mm;
                background: #ffffff;
            }
            
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

    <div class="header clearfix">
        <div class="header-left">
            <h2>{{ $config['app_name'] ?? 'Sekretariat Highlandtion' }}</h2>
        </div>
        <div class="header-right">
            <span class="badge">Kartu Registrasi</span>
        </div>
    </div>

    <div class="school">
        <div class="school-name">SMAN 1 BUKITTINGGI</div>
        <div class="school-address">
            Jl. Syekh Jamil Jambek No.36, Pakan Kurai, Kec. Guguk Panjang,
            Kota Bukittinggi, Sumatera Barat 26136
        </div>
    </div>

    <div class="section">
        <div class="section-title">Data Peserta</div>

        <div class="info-block">
            <div class="info-label">Nama Peserta</div>
            <div class="info-value">{{ $registrasi->nama }}</div>
        </div>

        <div class="info-block">
            <div class="info-label">Sekolah Asal</div>
            <div class="info-value">{{ $registrasi->asal_sekolah }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detail Tiket</div>

        <div class="info-block">
            <div class="info-label">Event</div>
            <div class="info-value">
                {{ $registrasi->menu->menuCategory->name }} - 
                {{ $registrasi->menu->mata_pelajaran }}
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-half">
                <div class="info-label">Tingkat</div>
                <div class="info-value">{{ $registrasi->menu->tingkat }}</div>
            </div>
            <div class="col-half">
                <div class="info-label">Ruang / Lokasi</div>
                <div class="info-value">{{ $registrasi->ruangan->nama_ruangan }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Waktu</div>

        <div class="row clearfix">
            <div class="col-half">
                <div class="info-label">Waktu Pendaftaran</div>
                <div class="info-value">{{ $registrasi->created_at->format('d M Y, H:i') }} WIB</div>
            </div>
            <div class="col-half">
                <div class="info-label">Waktu Verifikasi</div>
                <div class="info-value">{{ $registrasi->updated_at->format('d M Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

    <div class="reg-box">
        <span class="reg-label">Nomor Registrasi</span>
        <h3 class="reg-code">{{ $registrasi->registration_code }}</h3>
    </div>

    <div class="footer">
        Dokumen ini sah dan diterbitkan secara elektronik oleh sekretariat {{ $config['app_name'] }}.
    </div>

</body>
</html>