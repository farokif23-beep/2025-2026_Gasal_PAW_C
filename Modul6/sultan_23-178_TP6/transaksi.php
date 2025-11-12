<?php
include "koneksi.php";

if (isset($_POST['buat'])) {
    mysqli_query($koneksi, "INSERT INTO transaksi (tanggal) VALUES (NOW())");

    // Ambil ID terakhir
    $last_id = mysqli_insert_id($koneksi);

    // Redirect ke detil_transaksi
    echo "<script>
        alert('Transaksi baru dibuat dengan ID: $last_id');
        window.location='detil_transaksi.php?id=$last_id';
    </script>";
}
?>

<h2>Transaksi</h2>
<form method="post">
    <button type="submit" name="buat">Buat Transaksi Baru</button>
</form>

<hr>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Tanggal</th><th>Total</th><th>Aksi</th></tr>
<?php
$trx = mysqli_query($koneksi, "SELECT * FROM transaksi");
while ($r = mysqli_fetch_assoc($trx)) {
    echo "<tr>
            <td>{$r['transaksi_id']}</td>
            <td>{$r['tanggal']}</td>
            <td>{$r['total']}</td>
            <td><a href='detil_transaksi.php?id={$r['transaksi_id']}'>Input Detil</a></td>
          </tr>";
}
?>
</table>
