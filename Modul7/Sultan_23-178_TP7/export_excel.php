<?php
include "koneksi.php";

$mulai = $_POST['mulai'];
$akhir = $_POST['akhir'];

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Laporan_$mulai-$akhir.xls");

// Ambil data rekap
$data = mysqli_query($koneksi,
    "SELECT DATE(tanggal) AS tgl,
            COUNT(*) AS transaksi,
            SUM(total) AS pendapatan
     FROM transaksi
     WHERE DATE(tanggal) BETWEEN '$mulai' AND '$akhir'
     GROUP BY DATE(tanggal)"
);

// Ambil total
$total = mysqli_fetch_assoc(mysqli_query($koneksi,
    "SELECT COUNT(*) AS pelanggan,
            SUM(total) AS pendapatan
     FROM transaksi
     WHERE DATE(tanggal) BETWEEN '$mulai' AND '$akhir'"
));
?>

<!-- Judul -->
<h2>Rekap Laporan Penjualan</h2>
<strong><?= $mulai ?> sampai <?= $akhir ?></strong>
<br><br>

<!-- Tabel Rekap -->
<table border="1" cellspacing="0" cellpadding="6">
    <tr style="background:#ddd;">
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php 
    $no = 1;
    while ($d = mysqli_fetch_assoc($data)) { 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td>Rp. <?= number_format($d['pendapatan']); ?></td>
        <td><?= date('d-M-Y', strtotime($d['tgl'])); ?></td>
    </tr>
    <?php } ?>
</table>

<br><br>

<!-- Bagian Total -->
<table border="0" cellpadding="6">
    <tr>
        <td><strong>Jumlah Pelanggan</strong></td>
        <td>:</td>
        <td><?= $total['pelanggan']; ?> Orang</td>
    </tr>
    <tr>
        <td><strong>Jumlah Pendapatan</strong></td>
        <td>:</td>
        <td>Rp. <?= number_format($total['pendapatan']); ?></td>
    </tr>
</table>
