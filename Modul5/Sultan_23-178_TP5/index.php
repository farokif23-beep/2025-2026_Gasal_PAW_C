<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
</head>
<body>
<h2>Data Master Supplier</h2>

<a href="tambah.php">+ Tambah Data</a><br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM supplier");
    while ($row = mysqli_fetch_array($data)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_supplier']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['telepon']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
