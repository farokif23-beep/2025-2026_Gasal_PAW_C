<?php
include "../koneksi.php";
include "../header.php";

// Ambil data supplier
data_supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<h2>Data Supplier</h2>
<a href="tambah_supplier.php">+ Tambah Supplier</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data_supplier)) { ?>
        <tr>
            <td><?php echo $row['id_supplier']; ?></td>
            <td><?php echo $row['nama_supplier']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['telepon']; ?></td>
            <td>
                <a href="edit_supplier.php?id=<?php echo $row['id_supplier']; ?>">Edit</a> |
                <a href="hapus_supplier.php?id=<?php echo $row['id_supplier']; ?>" onclick="return confirm('Hapus supplier ini?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
include "../footer.php";
?>
