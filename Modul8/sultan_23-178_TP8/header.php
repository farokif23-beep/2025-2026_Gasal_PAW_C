<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Toko</title>
    <link rel="stylesheet" href="/23-178_FAROK_TP8/style.css">
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <a href="/23-178_FAROK_TP8/home.php">🏠 Home</a>

        <?php if ($_SESSION['level'] == 1): ?>
            <a href="/23-178_FAROK_TP8/master/barang.php">📦 Data Master</a>
        <?php endif; ?>

        <a href="/23-178_FAROK_TP8/transaksi/transaksi.php">💳 Transaksi</a>
        <a href="/23-178_FAROK_TP8/laporan/laporan_transaksi.php">📊 Laporan</a>
    </div>

    <div class="nav-right">
        <span class="user-info">
            <?php
                echo ($_SESSION['level'] == 1 ? "👑 Admin: " : "👤 User: ");
                echo $_SESSION['username'];
            ?>
        </span>
        <a href="/23-178_FAROK_TP8/logout.php" class="btn-logout">🚪 Logout</a>
    </div>
</div>

<div class="content">
