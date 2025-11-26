<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Redirect ke home.php
header("Location: home.php");
exit;
?>