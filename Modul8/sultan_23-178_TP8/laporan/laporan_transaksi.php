<?php
include "../koneksi.php";
include "../header.php";

// Ambil data transaksi
$data = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY tanggal DESC");
?>

<h2>Laporan Transaksi</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Total</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?php echo $row['transaksi_id']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo number_format($row['total']); ?></td>
        </tr>
    <?php } ?>
</table>

<?php include "../footer.php"; ?>
