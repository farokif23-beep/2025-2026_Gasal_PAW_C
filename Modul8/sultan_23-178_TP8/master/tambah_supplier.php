<?php
include "../koneksi.php";
include "../header.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier, alamat, telepon) VALUES ('$nama', '$alamat', '$telepon')");

    echo "<script>alert('Supplier berhasil ditambahkan!'); window.location='supplier.php';</script>";
}
?>

<h2>Tambah Supplier</h2>

<form method="POST">
    <label>Nama Supplier:</label><br>
    <input type="text" name="nama_supplier" required><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" required></textarea><br><br>

    <label>Telepon:</label><br>
    <input type="text" name="telepon" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<?php include "../footer.php"; ?>