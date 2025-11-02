<?php include "koneksi.php"; ?>

<?php
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$row = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
</head>
<body>
<h2>Edit Data Supplier</h2>

<form method="post" action="">
    <label>Nama Supplier:</label><br>
    <input type="text" name="nama_supplier" value="<?= $row['nama_supplier']; ?>"><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat"><?= $row['alamat']; ?></textarea><br><br>

    <label>Telepon:</label><br>
    <input type="text" name="telepon" value="<?= $row['telepon']; ?>"><br><br>

    <input type="submit" name="update" value="Update">
</form>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $update = mysqli_query($koneksi, "UPDATE supplier SET nama_supplier='$nama', alamat='$alamat', telepon='$telepon' WHERE id='$id'");
    if ($update) {
        echo "Data berhasil diupdate. <a href='index.php'>Lihat Data</a>";
    } else {
        echo "Gagal update data.";
    }
}
?>
</body>
</html>
