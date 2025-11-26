<?php
include "../koneksi.php";
include "../header.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga) VALUES ('$nama', '$harga')");

    echo "<script>alert('Barang berhasil ditambahkan!'); window.location='barang.php';</script>";
}
?>

<h2>Tambah Barang</h2>

<form method="POST">
    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang" required><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<?php include "../footer.php"; ?>
