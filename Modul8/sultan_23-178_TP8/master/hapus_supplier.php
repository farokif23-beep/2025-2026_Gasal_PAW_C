<?php
include "../koneksi.php";

$id = $_GET['id'];

// Cek apakah supplier memiliki relasi dengan transaksi atau tabel lain (opsional)
// Jika tidak dibutuhkan, bisa langsung hapus

mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier='$id'");

echo "<script>alert('Supplier berhasil dihapus!'); window.location='supplier.php';</script>";
?>
