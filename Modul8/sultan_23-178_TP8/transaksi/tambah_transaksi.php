<?php
include "../koneksi.php";
include "../header.php";

// Ambil data barang untuk dropdown
$barang = mysqli_query($koneksi, "SELECT * FROM barang");

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];

    // Insert transaksi utama dulu
    mysqli_query($koneksi, "INSERT INTO transaksi (tanggal, total) VALUES ('$tanggal', 0)");
    $id_transaksi = mysqli_insert_id($koneksi);

    $total = 0;

    // Loop barang yang diinputkan
    foreach ($_POST['barang_id'] as $key => $id_barang) {
        $jumlah = $_POST['jumlah'][$key];

        // Ambil harga
        $h = mysqli_query($koneksi, "SELECT harga FROM barang WHERE barang_id='$id_barang'");
        $data_harga = mysqli_fetch_assoc($h);
        $harga = $data_harga['harga'];

        $subtotal = $jumlah * $harga;
        $total += $subtotal;

        // Insert detil transaksi
        mysqli_query($koneksi, "INSERT INTO detil_transaksi (transaksi_id, barang_id, jumlah, subtotal)
        VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$subtotal')");
    }

    // Update total transaksi
    mysqli_query($koneksi, "UPDATE transaksi SET total='$total' WHERE transaksi_id='$id_transaksi'");

    echo "<script>
        alert('✅ Transaksi berhasil disimpan!'); 
        window.location='transaksi.php';
    </script>";
}
?>

<div class="content-wrapper">
    <div class="page-header">
        <h2>🛒 Tambah Transaksi Baru</h2>
        <a href="transaksi.php" class="btn btn-secondary">
            <span class="btn-icon">◀️</span> Kembali
        </a>
    </div>

    <div class="form-container">
        <form method="POST" class="modern-form">
            <div class="form-group">
                <label>📅 Tanggal & Waktu:</label>
                <input type="datetime-local" name="tanggal" required>
            </div>

            <div class="form-section">
                <h3>🛍️ Daftar Barang</h3>
                <div id="form-barang" class="barang-list">
                    <div class="barang-row">
                        <div class="barang-item">
                            <select name="barang_id[]" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php 
                                mysqli_data_seek($barang, 0); // Reset pointer
                                while ($b = mysqli_fetch_assoc($barang)) { 
                                ?>
                                    <option value="<?php echo $b['barang_id']; ?>">
                                        <?php echo $b['nama_barang']; ?> - Rp <?php echo number_format($b['harga'], 0, ',', '.'); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="barang-qty">
                            <input type="number" name="jumlah[]" placeholder="Jumlah" min="1" required>
                        </div>
                        <div class="barang-action">
                            <button type="button" class="btn-remove" onclick="hapusBaris(this)" style="display:none;">🗑️</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success" onclick="tambahBaris()">
                ➕ Tambah Barang
            </button>

            <div class="form-actions">
                <button type="submit" name="simpan" class="btn btn-primary">
                    💾 Simpan Transaksi
                </button>
                <a href="transaksi.php" class="btn btn-secondary">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
let rowCount = 1;

function tambahBaris() {
    rowCount++;
    let container = document.getElementById('form-barang');
    let baru = document.createElement('div');
    baru.classList.add('barang-row');
    baru.innerHTML = `
        <div class="barang-item">
            <select name="barang_id[]" required>
                <option value="">-- Pilih Barang --</option>
                <?php
                mysqli_data_seek($barang, 0);
                while ($b2 = mysqli_fetch_assoc($barang)) {
                    echo '<option value="'.$b2['barang_id'].'">'.$b2['nama_barang'].' - Rp '.number_format($b2['harga'], 0, ',', '.').'</option>';
                }
                ?>
            </select>
        </div>
        <div class="barang-qty">
            <input type="number" name="jumlah[]" placeholder="Jumlah" min="1" required>
        </div>
        <div class="barang-action">
            <button type="button" class="btn-remove" onclick="hapusBaris(this)">🗑️</button>
        </div>
    `;
    container.appendChild(baru);
    updateRemoveButtons();
}

function hapusBaris(btn) {
    btn.closest('.barang-row').remove();
    rowCount--;
    updateRemoveButtons();
}

function updateRemoveButtons() {
    let rows = document.querySelectorAll('.barang-row');
    rows.forEach((row, index) => {
        let removeBtn = row.querySelector('.btn-remove');
        if (rows.length > 1) {
            removeBtn.style.display = 'inline-block';
        } else {
            removeBtn.style.display = 'none';
        }
    });
}
</script>

<?php include "../footer.php"; ?>