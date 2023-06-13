<!DOCTYPE html>
<html>

<head>
    <title>Kartu Cetak Antrian Puskesmas</title>
    <style>
        .card {
            width: 300px;
            padding: 20px;
            border: 1px solid #000;
            text-align: center;
        }

        .card h1 {
            margin-top: 0;
        }

        .card h2 {
            margin-bottom: 20px;
        }

        .card p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Nomor Antrian Puskesmas</h1>
        <h3>Nomor Antrian Saat Ini:</h3>
        <h1> <?php echo $nomor_antrian_baru; ?></h1>
        <h2>Poliknik : <?php echo $nama_poli; ?></h2>
        <p>Tanggal: <?php echo date('Y-m-d'); ?></p>
        <p>Jam: <?php echo date('H:i:s'); ?></p>
    </div>
</body>

</html>