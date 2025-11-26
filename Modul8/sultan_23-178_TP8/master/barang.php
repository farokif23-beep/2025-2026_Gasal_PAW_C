<?php
include "../koneksi.php";
include "../header.php";

// Ambil data barang
$data_barang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!-- Panggil CSS kamu -->
<link rel="stylesheet" href="../style.css">

<h2>Data Barang</h2>
<a href="tambah_barang.php">+ Tambah Barang</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data_barang)) { ?>
        <tr>
            <td><?php echo $row['barang_id']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo number_format($row['harga']); ?></td>
            <td>
                <a href="edit_barang.php?id=<?php echo $row['barang_id']; ?>">Edit</a> |
                <a href="hapus_barang.php?id=<?php echo $row['barang_id']; ?>" onclick="return confirm('Hapus barang ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
include "../footer.php";
?>
