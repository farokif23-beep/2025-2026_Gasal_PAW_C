<?php
include "../koneksi.php";
include "../header.php";

// Ambil ID barang
$id = $_GET['id'];

// Ambil data barang berdasarkan ID
$data = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$id'");
$barang = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama', harga='$harga' WHERE barang_id='$id'");

    echo "<script>alert('Barang berhasil diupdate!'); window.location='barang.php';</script>";
}
?>

<h2>Edit Barang</h2>

<form method="POST">
    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>" required><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" value="<?php echo $barang['harga']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>

<?php include "../footer.php"; ?>
