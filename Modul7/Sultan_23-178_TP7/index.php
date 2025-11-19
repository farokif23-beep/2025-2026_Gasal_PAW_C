<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Modul 7 Reporting</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Tambahan CSS untuk Print + tombol -->
    <style>
        body { font-family: Arial; margin: 20px; }
        .box { border:1px solid #aaa; padding:15px; margin-top:20px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #333; padding:8px; text-align:center; }
        th { background:#eee; }

        /* Tampilan tombol*/
        .btn-area {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        button {
            padding: 10px 18px;
            border: none;
            background: #e67e22;
            color: white;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { opacity: 0.85; }

    
        /* AGAR PRINT RAPI                        */
        /* ====================================== */
        @media print {
            button, form { display: none !important; } /* Hilangkan tombol saat print */
            .box { break-inside: avoid; }
            canvas { max-width: 100% !important; height: auto !important; }
        }
    </style>
</head>
<body>

<h2>Laporan Penjualan</h2>


<!-- 7.1 Nomor 1 : FILTER TANGGAL -->

<form method="GET">
    Dari: <input type="date" name="mulai" required>
    Sampai: <input type="date" name="akhir" required>
    <button type="submit">Cari</button>
</form>
<br>

<?php
if (isset($_GET['mulai'])) {

    $mulai = $_GET['mulai'];
    $akhir = $_GET['akhir'];

    // Query rekap & grafik
    $rekap = mysqli_query($koneksi,
        "SELECT DATE(tanggal) AS tgl,
                COUNT(*) AS transaksi,
                SUM(total) AS pendapatan
         FROM transaksi
         WHERE DATE(tanggal) BETWEEN '$mulai' AND '$akhir'
         GROUP BY DATE(tanggal)"
    );

    $tgl_array = [];
    $pendapatan_array = [];
    $data_rekap = [];

    while ($row = mysqli_fetch_assoc($rekap)) {
        $tgl_array[] = $row['tgl'];
        $pendapatan_array[] = $row['pendapatan'];
        $data_rekap[] = $row;
    }

    // TOTAL
    $t = mysqli_fetch_assoc(mysqli_query($koneksi,
        "SELECT COUNT(*) AS pelanggan, SUM(total) AS pendapatan
         FROM transaksi
         WHERE DATE(tanggal) BETWEEN '$mulai' AND '$akhir'"
    ));
?>


<!-- HEADER LAPORAN (WAJIB UNTUK PRINT) -->

<div style="margin-top: 20px; margin-bottom: 20px;">
    <h2 style="margin:0; padding:0;">Rekap Laporan Penjualan</h2>
    <small><?= $mulai ?> sampai <?= $akhir ?></small>
</div>
<hr>


<!-- 7.1 Nomor 3a : GRAFIK PENJUALAN -->

<div class="box">
    <h3>Grafik Penjualan</h3>
    <canvas id="myChart"></canvas>
</div>

<script>
new Chart(document.getElementById("myChart"), {
    type: "bar",
    data: {
        labels: <?= json_encode($tgl_array); ?>,
        datasets: [{
            label: "Total",
            data: <?= json_encode($pendapatan_array); ?>,
            backgroundColor: "rgba(230, 126, 34, 0.5)",
            borderColor: "rgba(211, 84, 0, 1)",
            borderWidth: 1
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
</script>


<!-- 7.1 Nomor 3b : REKAP TABEL -->

<div class="box">
    <h3>Rekap Penjualan</h3>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Jumlah Transaksi</th>
            <th>Total Pendapatan</th>
        </tr>

        <?php foreach($data_rekap as $d): ?>
        <tr>
            <td><?= $d['tgl'] ?></td>
            <td><?= $d['transaksi'] ?></td>
            <td>Rp <?= number_format($d['pendapatan']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>


<!-- 7.1 Nomor 3c : TOTAL -->

<div class="box">
    <h3>Total</h3>
    <p>Total Pelanggan : <?= $t['pelanggan'] ?></p>
    <p>Total Pendapatan : Rp <?= number_format($t['pendapatan']) ?></p>
</div>


<!-- 7.1 Nomor 4 : PRINT & EXPORT EXCEL -->

<div class="btn-area">
    <button onclick="window.print()">Print</button>

    <form action="export_excel.php" method="POST">
        <input type="hidden" name="mulai" value="<?= $mulai ?>">
        <input type="hidden" name="akhir" value="<?= $akhir ?>">
        <button type="submit">Export Excel</button>
    </form>
</div>

<?php } ?>

</body>
</html>
