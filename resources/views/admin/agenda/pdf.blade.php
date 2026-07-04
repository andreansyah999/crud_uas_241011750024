<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Agenda Kegiatan</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 20px;
            color: #1e1b4b;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 0;
            color: #6b7280;
            font-size: 11px;
        }
        .meta-info {
            width: 100%;
            margin-bottom: 15px;
            font-size: 10px;
            color: #4b5563;
        }
        .meta-info td {
            padding: 2px 0;
        }
        .meta-info .right {
            text-align: right;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #f3f4f6;
            color: #1f2937;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        table.data-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            background-color: #f0fdfa;
            color: #0f766e;
            border: 1px solid #ccfbf1;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }
        .agenda-text {
            font-size: 9.5px;
            color: #4b5563;
            white-space: pre-line;
            margin: 0;
        }
        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
            padding-top: 5px;
        }
        .page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Laporan Data Agenda Kegiatan</h1>
        <p>Portal Informasi Agenda & Organisasi - Eventure</p>
    </div>

    <!-- Metadata -->
    <table class="meta-info">
        <tr>
            <td>Dicetak Oleh: <strong>Administrator</strong></td>
            <td class="right">Tanggal Cetak: <strong>{{ now()->translatedFormat('d F Y, H:i') }} WIB</strong></td>
        </tr>
        <tr>
            <td>Kategori: <strong>Data Agenda Kegiatan (UAS)</strong></td>
            <td class="right">Total Agenda: <strong>{{ count($agendas) }} Data</strong></td>
        </tr>
    </table>

    <!-- Main Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%; text-align: center;">No</th>
                <th style="width: 20%;">Nama Kegiatan</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 16%;">Tempat / Lokasi</th>
                <th style="width: 16%;">Penyelenggara</th>
                <th style="width: 32%;">Detail Rincian Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $index => $agenda)
                <tr>
                    <td style="text-align: center; font-weight: bold;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold; color: #1e1b4b;">{{ $agenda->nama_kegiatan }}</td>
                    <td style="font-weight: 550;">
                        {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->translatedFormat('d M Y') }}
                    </td>
                    <td>{{ $agenda->lokasi }}</td>
                    <td><span class="badge">{{ $agenda->penyelenggara }}</span></td>
                    <td>
                        <p class="agenda-text">{{ Str::limit($agenda->agenda, 300) }}</p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #9ca3af; font-style: italic; padding: 20px;">
                        Belum ada agenda kegiatan yang diinputkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer Page Number -->
    <div class="footer">
        Halaman <span class="page-number"></span> &bull; Laporan Otomatis Eventure &bull; NIM 241011750024
    </div>

</body>
</html>
