<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Supplier</title>
</head>
<body>
<h2>Tambah Data Supplier</h2>

<form method="post" action="">
    <label>Nama Supplier:</label><br>
    <input type="text" name="nama_supplier" required><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" required></textarea><br><br>

    <label>Telepon:</label><br>
    <input type="text" name="telepon" required><br><br>

    <input type="submit" name="simpan" value="Simpan">
    <input type="button" value="Batal" onclick="window.location.href='index.php'">
</form>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $query = mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier, alamat, telepon) VALUES ('$nama', '$alamat', '$telepon')");
    if ($query) {
        echo "Data berhasil disimpan. <a href='index.php'>Lihat Data</a>";
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>
</body>
</html>
    