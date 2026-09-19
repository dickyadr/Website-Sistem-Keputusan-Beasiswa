<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Beasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #667eea;
            color: white;
        }
        .text-center {
            text-align: center;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL KEPUTUSAN BEASISWA</h2>
        <h3>Metode SMART (Simple Multi-Attribute Rating Technique)</h3>
        <p>Tanggal: <?php echo date('d F Y'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>IPK</th>
                <th>Total Nilai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($hasil)): ?>
                <?php foreach ($hasil as $h): ?>
                    <tr>
                        <td class="text-center"><?php echo $h->ranking; ?></td>
                        <td><?php echo $h->nim; ?></td>
                        <td><?php echo $h->nama; ?></td>
                        <td><?php echo $h->jurusan; ?></td>
                        <td class="text-center"><?php echo $h->ipk ? number_format($h->ipk, 2) : '-'; ?></td>
                        <td class="text-center"><?php echo number_format($h->total_nilai, 4); ?></td>
                        <td class="text-center"><?php echo $h->status; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="no-print" style="margin-top: 20px;">
        <button onclick="window.print()" class="btn">Cetak</button>
        <button onclick="window.close()" class="btn">Tutup</button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>

