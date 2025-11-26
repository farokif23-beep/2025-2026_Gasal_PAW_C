<?php
include "../koneksi.php";

$id = $_GET['id'];

// Cek apakah barang sudah dipakai di detil_transaksi
$cek = mysqli_query($koneksi, "SELECT * FROM detil_transaksi WHERE barang_id='$id'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Barang tidak bisa dihapus karena sudah dipakai di transaksi!'); window.location='barang.php';</script>";
    exit;
}

// Hapus barang
mysqli_query($koneksi, "DELETE FROM barang WHERE barang_id='$id'");

echo "<script>alert('Barang berhasil dihapus!'); window.location='barang.php';</script>";
?>
