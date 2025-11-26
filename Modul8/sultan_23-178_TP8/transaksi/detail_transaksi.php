<?php
include "../koneksi.php";
include "../header.php";

$id = $_GET['id'];

// Ambil data transaksi
$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id'");
$data_transaksi = mysqli_fetch_assoc($transaksi);

// Ambil detail transaksi dengan join ke tabel barang
$detail = mysqli_query($koneksi, "
    SELECT dt.*, b.nama_barang, b.harga 
    FROM detil_transaksi dt
    JOIN barang b ON dt.barang_id = b.barang_id
    WHERE dt.transaksi_id='$id'
");
?>

<div class="content-wrapper">
    <div class="page-header">
        <h2>🧾 Detail Transaksi #<?php echo $data_transaksi['transaksi_id']; ?></h2>
        <a href="transaksi.php" class="btn btn-secondary">
            <span class="btn-icon">◀️</span> Kembali
        </a>
    </div>

    <div class="detail-container">
        <div class="info-card">
            <div class="info-row">
                <span class="info-label">📅 Tanggal:</span>
                <span class="info-value"><?php echo date('d F Y, H:i', strtotime($data_transaksi['tanggal'])); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">💰 Total Transaksi:</span>
                <span class="info-value total-highlight">Rp <?php echo number_format($data_transaksi['total'], 0, ',', '.'); ?></span>
            </div>
        </div>

        <h3 class="section-title">📦 Item yang Dibeli</h3>
        
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $grand_total = 0;
                    while ($row = mysqli_fetch_assoc($detail)) { 
                        $grand_total += $row['subtotal'];
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><strong><?php echo $row['nama_barang']; ?></strong></td>
                            <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><span class="badge badge-primary"><?php echo $row['jumlah']; ?> pcs</span></td>
                            <td><strong class="text-success">Rp <?php echo number_format($row['subtotal'], 0, ',', '.'); ?></strong></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="4" class="text-right"><strong>TOTAL:</strong></td>
                        <td><strong class="total-highlight">Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="action-buttons">
            <button onclick="window.print()" class="btn btn-success">
                🖨️ Cetak Struk
            </button>
            <a href="transaksi.php" class="btn btn-secondary">
                ◀️ Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    .page-header, .action-buttons, .btn {
        display: none !important;
    }
    .content-wrapper {
        padding: 20px;
    }
}
</style>

<?php include "../footer.php"; ?>