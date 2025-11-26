<?php
include "../koneksi.php";
include "../header.php";
?>

<!-- Load CSS khusus untuk halaman transaksi -->
<link rel="stylesheet" href="transaksi-style.css">

<?php
// Ambil semua transaksi
$data_transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY tanggal DESC");

// Hitung statistik
$total_transaksi = mysqli_num_rows($data_transaksi);
$query_total_pendapatan = mysqli_query($koneksi, "SELECT SUM(total) as total_pendapatan FROM transaksi");
$data_pendapatan = mysqli_fetch_assoc($query_total_pendapatan);
$total_pendapatan = $data_pendapatan['total_pendapatan'] ?? 0;

// Transaksi hari ini
$query_today = mysqli_query($koneksi, "SELECT COUNT(*) as today_count, SUM(total) as today_total FROM transaksi WHERE DATE(tanggal) = CURDATE()");
$data_today = mysqli_fetch_assoc($query_today);
$transaksi_hari_ini = $data_today['today_count'];
$pendapatan_hari_ini = $data_today['today_total'] ?? 0;

// Reset pointer
mysqli_data_seek($data_transaksi, 0);
?>

<div class="content-wrapper">
    <!-- Hero Section -->
    <div class="transaksi-hero">
        <div class="transaksi-hero-content">
            <h1 class="hero-title">📊 Manajemen Transaksi</h1>
            <p class="hero-subtitle">Kelola dan pantau semua transaksi bisnis Anda</p>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-icon">💰</span>
                    <div class="stat-label">Total Pendapatan</div>
                    <div class="stat-value">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></div>
                </div>
                
                <div class="stat-card">
                    <span class="stat-icon">📝</span>
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value"><?php echo $total_transaksi; ?></div>
                </div>
                
                <div class="stat-card">
                    <span class="stat-icon">📅</span>
                    <div class="stat-label">Transaksi Hari Ini</div>
                    <div class="stat-value"><?php echo $transaksi_hari_ini; ?></div>
                </div>
                
                <div class="stat-card">
                    <span class="stat-icon">💵</span>
                    <div class="stat-label">Pendapatan Hari Ini</div>
                    <div class="stat-value">Rp <?php echo number_format($pendapatan_hari_ini, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="search-filter-section">
        <div class="search-box">
            <span class="search-icon">🔍</span>
            <input type="text" id="searchInput" placeholder="Cari transaksi..." onkeyup="searchTable()">
        </div>
        
        <div class="filter-buttons">
            <button class="filter-btn active" onclick="filterByDate('all')">Semua</button>
            <button class="filter-btn" onclick="filterByDate('today')">Hari Ini</button>
            <button class="filter-btn" onclick="filterByDate('week')">Minggu Ini</button>
            <button class="filter-btn" onclick="filterByDate('month')">Bulan Ini</button>
        </div>
        
        <a href="tambah_transaksi.php" class="btn btn-primary">
            <span class="btn-icon">➕</span> Transaksi Baru
        </a>
    </div>

    <!-- Table Section -->
    <div class="modern-table-wrapper">
        <div class="table-header-actions">
            <div class="entries-info">
                Menampilkan <strong><?php echo mysqli_num_rows($data_transaksi); ?></strong> transaksi
            </div>
            <div class="table-actions">
                <button class="action-icon-btn" title="Export Excel" onclick="alert('Fitur export akan segera hadir!')">📥</button>
                <button class="action-icon-btn" title="Print" onclick="window.print()">🖨️</button>
                <button class="action-icon-btn" title="Refresh" onclick="location.reload()">🔄</button>
            </div>
        </div>
        
        <table class="modern-table" id="transaksiTable">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal & Waktu</th>
                    <th>Total Pembelian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($data_transaksi) > 0) {
                    while ($row = mysqli_fetch_assoc($data_transaksi)) { 
                        $status = ($row['total'] >= 100000) ? 'premium' : 'reguler';
                        $status_icon = ($status == 'premium') ? '⭐' : '✓';
                ?>
                    <tr data-tanggal="<?php echo $row['tanggal']; ?>">
                        <td>
                            <span class="badge badge-info">#<?php echo str_pad($row['transaksi_id'], 4, '0', STR_PAD_LEFT); ?></span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 18px;">📅</span>
                                <div>
                                    <strong><?php echo date('d M Y', strtotime($row['tanggal'])); ?></strong><br>
                                    <small style="color: #999;"><?php echo date('H:i', strtotime($row['tanggal'])); ?> WIB</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong class="text-success" style="font-size: 16px;">
                                Rp <?php echo number_format($row['total'], 0, ',', '.'); ?>
                            </strong>
                        </td>
                        <td>
                            <span class="badge <?php echo ($status == 'premium') ? 'badge-primary' : 'badge-info'; ?>">
                                <?php echo $status_icon . ' ' . ucfirst($status); ?>
                            </span>
                        </td>
                        <td>
                            <a href="detail_transaksi.php?id=<?php echo $row['transaksi_id']; ?>" class="btn-action btn-detail">
                                👁️ Lihat Detail
                            </a>
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">📭</div>
                                <div class="empty-text">Belum ada transaksi</div>
                                <a href="tambah_transaksi.php" class="btn btn-primary">
                                    ➕ Buat Transaksi Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Search function
function searchTable() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toUpperCase();
    let table = document.getElementById('transaksiTable');
    let tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                let txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        
        tr[i].style.display = found ? '' : 'none';
    }
}

// Filter by date
function filterByDate(period) {
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    let table = document.getElementById('transaksiTable');
    let tr = table.getElementsByTagName('tr');
    let today = new Date();
    today.setHours(0, 0, 0, 0);
    
    for (let i = 1; i < tr.length; i++) {
        let dateStr = tr[i].getAttribute('data-tanggal');
        if (!dateStr) continue;
        
        let rowDate = new Date(dateStr);
        rowDate.setHours(0, 0, 0, 0);
        
        let show = true;
        
        if (period === 'today') {
            show = rowDate.getTime() === today.getTime();
        } else if (period === 'week') {
            let weekAgo = new Date(today);
            weekAgo.setDate(weekAgo.getDate() - 7);
            show = rowDate >= weekAgo && rowDate <= today;
        } else if (period === 'month') {
            show = rowDate.getMonth() === today.getMonth() && 
                   rowDate.getFullYear() === today.getFullYear();
        }
        
        tr[i].style.display = show ? '' : 'none';
    }
}
</script>

<?php include "../footer.php"; ?>