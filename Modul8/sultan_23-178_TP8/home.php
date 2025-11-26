<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "header.php";
?>

<div class="home-container">
    <div class="welcome-card">
        <div class="welcome-icon">👋</div>
        <h1>Selamat Datang!</h1>
        <h2><?php echo $_SESSION['username']; ?></h2>
        
        <?php if ($_SESSION['level'] == 1): ?>
            <p class="user-role">Anda login sebagai <strong>Administrator</strong></p>
            <p class="access-info">Anda memiliki akses penuh ke semua fitur sistem</p>
        <?php else: ?>
            <p class="user-role">Anda login sebagai <strong>User</strong></p>
            <p class="access-info">Anda dapat mengakses Transaksi dan Laporan</p>
        <?php endif; ?>
    </div>

    <div class="quick-stats">
        <h3>📊 Statistik Cepat</h3>
        <div class="stats-row">
            <?php
            include "koneksi.php";
            
            // Hitung total transaksi
            $total_transaksi = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi");
            $data_transaksi = mysqli_fetch_assoc($total_transaksi);
            
            // Hitung total barang (hanya untuk level 1)
            if ($_SESSION['level'] == 1) {
                $total_barang = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM barang");
                $data_barang = mysqli_fetch_assoc($total_barang);
            }
            
            // Total pendapatan
            $total_pendapatan = mysqli_query($koneksi, "SELECT SUM(total) as total FROM transaksi");
            $data_pendapatan = mysqli_fetch_assoc($total_pendapatan);
            ?>
            
            <?php if ($_SESSION['level'] == 1): ?>
            <div class="stat-box">
                <div class="stat-icon">📦</div>
                <div class="stat-number"><?php echo $data_barang['total']; ?></div>
                <div class="stat-label">Total Barang</div>
            </div>
            <?php endif; ?>
            
            <div class="stat-box">
                <div class="stat-icon">💳</div>
                <div class="stat-number"><?php echo $data_transaksi['total']; ?></div>
                <div class="stat-label">Total Transaksi</div>
            </div>
            
            <div class="stat-box">
                <div class="stat-icon">💰</div>
                <div class="stat-number">Rp <?php echo number_format($data_pendapatan['total'], 0, ',', '.'); ?></div>
                <div class="stat-label">Total Pendapatan</div>
            </div>
        </div>
    </div>

    <div class="quick-menu">
        <h3>⚡ Menu Cepat</h3>
        <div class="menu-row">
            <?php if ($_SESSION['level'] == 1): ?>
            <a href="master/barang.php" class="quick-link">
                <span class="link-icon">📦</span>
                <span class="link-text">Kelola Barang</span>
            </a>
            <?php endif; ?>
            
            <a href="transaksi/transaksi.php" class="quick-link">
                <span class="link-icon">💳</span>
                <span class="link-text">Lihat Transaksi</span>
            </a>
            
            <a href="laporan/laporan_transaksi.php" class="quick-link">
                <span class="link-icon">📊</span>
                <span class="link-text">Lihat Laporan</span>
            </a>
        </div>
    </div>
</div>

<style>
.home-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px;
}

.welcome-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 50px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 30px;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
}

.welcome-icon {
    font-size: 80px;
    margin-bottom: 20px;
}

.welcome-card h1 {
    font-size: 36px;
    margin-bottom: 10px;
}

.welcome-card h2 {
    font-size: 28px;
    margin-bottom: 20px;
    opacity: 0.9;
}

.user-role {
    font-size: 18px;
    margin-bottom: 10px;
}

.access-info {
    font-size: 14px;
    opacity: 0.8;
}

.quick-stats, .quick-menu {
    background: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.quick-stats h3, .quick-menu h3 {
    color: #667eea;
    margin-bottom: 25px;
    font-size: 22px;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-box {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ebff 100%);
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.stat-box:hover {
    transform: translateY(-5px);
    border-color: #667eea;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
}

.stat-icon {
    font-size: 40px;
    margin-bottom: 15px;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    color: #666;
    font-weight: 600;
}

.menu-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.quick-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    padding: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.quick-link:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
}

.link-icon {
    font-size: 50px;
}

.link-text {
    font-size: 16px;
    font-weight: 600;
}
</style>

<?php include "footer.php"; ?>