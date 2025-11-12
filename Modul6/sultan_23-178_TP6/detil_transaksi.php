<?php
include "koneksi.php";

// Pastikan ID transaksi dikirim lewat URL
if (!isset($_GET['id'])) {
    die("❌ ID Transaksi tidak ditemukan di URL! Silakan akses lewat <a href='transaksi.php'>transaksi.php</a>.");
}
$id_trx = $_GET['id'];

// Cek apakah transaksi benar-benar ada
$cek_trx = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id_trx'");
if (mysqli_num_rows($cek_trx) == 0) {
    die("❌ Transaksi dengan ID $id_trx tidak ditemukan di database!");
}

// Input detil
if (isset($_POST['tambah'])) {
    $barang_id = $_POST['barang_id'];
    $jumlah = $_POST['jumlah'];

    // Ambil harga barang
    $b = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'"));
    $subtotal = $b['harga'] * $jumlah;

    // Simpan ke tabel detil_transaksi
    $insert = mysqli_query($koneksi, "INSERT INTO detil_transaksi (transaksi_id, barang_id, jumlah, subtotal)
                                      VALUES ('$id_trx', '$barang_id', '$jumlah', '$subtotal')");

    if ($insert) {
        // Update total transaksi otomatis
        mysqli_query($koneksi, "UPDATE transaksi 
                                SET total = (SELECT SUM(subtotal) FROM detil_transaksi WHERE transaksi_id='$id_trx')
                                WHERE transaksi_id='$id_trx'");
    } else {
        echo "<script>alert('❌ Gagal menambahkan detil transaksi! Periksa kembali data.');</script>";
    }
}
?>

<h2>Detil Transaksi ID: <?= $id_trx ?></h2>

<form method="post">
    Pilih Barang:
    <select name="barang_id" required>
        <option value="">--Pilih Barang--</option>
        <?php
        // Tampilkan barang yang belum digunakan di transaksi ini
        $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id NOT IN 
                    (SELECT barang_id FROM detil_transaksi WHERE transaksi_id='$id_trx')");
        while ($r = mysqli_fetch_assoc($barang)) {
            echo "<option value='{$r['barang_id']}'>{$r['nama_barang']} - Rp{$r['harga']}</option>";
        }
        ?>
    </select><br><br>
    Jumlah: <input type="number" name="jumlah" required><br><br>
    <button type="submit" name="tambah">Tambah</button>
</form>

<hr>
<table border="1" cellpadding="5">
<tr><th>Barang</th><th>Jumlah</th><th>Subtotal</th></tr>
<?php
$detil = mysqli_query($koneksi, "SELECT d.*, b.nama_barang FROM detil_transaksi d 
                                JOIN barang b ON d.barang_id=b.barang_id
                                WHERE transaksi_id='$id_trx'");
while ($d = mysqli_fetch_assoc($detil)) {
    echo "<tr>
            <td>{$d['nama_barang']}</td>
            <td>{$d['jumlah']}</td>
            <td>Rp{$d['subtotal']}</td>
          </tr>";
}
?>
</table>
