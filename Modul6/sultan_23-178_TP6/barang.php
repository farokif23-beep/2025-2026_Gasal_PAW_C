<?php
include "koneksi.php";

// Hapus barang (dengan pengecekan)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $cek = mysqli_query($koneksi, "SELECT * FROM detil_transaksi WHERE barang_id='$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang tidak bisa dihapus karena sedang dipakai di transaksi.');</script>";
    } else {
        mysqli_query($koneksi, "DELETE FROM barang WHERE barang_id='$id'");
        echo "<script>alert('Barang berhasil dihapus.');</script>";
    }
}

// Tambah barang
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama','$harga','$stok')");
}
?>

<h2>Data Barang</h2>
<form method="post">
    Nama Barang: <input type="text" name="nama_barang" required><br>
    Harga: <input type="number" name="harga" required><br>
    Stok: <input type="number" name="stok" required><br>
    <button type="submit" name="simpan">Simpan</button>
</form>

<hr>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
<?php
$data = mysqli_query($koneksi, "SELECT * FROM barang");
while ($row = mysqli_fetch_assoc($data)) {
    echo "<tr>
            <td>{$row['barang_id']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['harga']}</td>
            <td>{$row['stok']}</td>
            <td><a href='?hapus={$row['barang_id']}'>Hapus</a></td>
          </tr>";
}
?>
</table>
