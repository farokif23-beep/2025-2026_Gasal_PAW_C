<?php
include "../koneksi.php";
include "../header.php";

$id = $_GET['id'];

// Ambil data supplier berdasarkan ID
$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'");
$supplier = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    mysqli_query($koneksi, "UPDATE supplier SET nama_supplier='$nama', alamat='$alamat', telepon='$telepon' WHERE id_supplier='$id'");

    echo "<script>alert('Supplier berhasil diupdate!'); window.location='supplier.php';</script>";
}
?>

<h2>Edit Supplier</h2>

<form method="POST">
    <label>Nama Supplier:</label><br>
    <input type="text" name="nama_supplier" value="<?php echo $supplier['nama_supplier']; ?>" required><br><br>

    <label>Alamat:</label><br>
    <textarea name="alamat" required><?php echo $supplier['alamat']; ?></textarea><br><br>

    <label>Telepon:</label><br>
    <input type="text" name="telepon" value="<?php echo $supplier['telepon']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>

<?php include "../footer.php"; ?>