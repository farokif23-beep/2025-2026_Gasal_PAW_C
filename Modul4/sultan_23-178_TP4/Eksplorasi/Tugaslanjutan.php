<?php
// tugas_lanjutan.php
// Tugas Lanjutan #7 & #8: Form Mahasiswa + Validasi Server-side

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi Nama
    if (empty($_POST["nama"])) {
        $errors["nama"] = "Nama wajib diisi";
    } elseif (!preg_match("/^[a-zA-Z\s'-]+$/", $_POST["nama"])) {
        $errors["nama"] = "Nama hanya boleh huruf dan spasi";
    }

    // Validasi NIM (hanya angka, panjang 8–12)
    if (empty($_POST["nim"])) {
        $errors["nim"] = "NIM wajib diisi";
    } elseif (!preg_match("/^[0-9]{8,12}$/", $_POST["nim"])) {
        $errors["nim"] = "NIM harus berupa angka 8–12 digit";
    }

    // Validasi Email
    if (empty($_POST["email"])) {
        $errors["email"] = "Email wajib diisi";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format email tidak valid";
    }

    // Validasi Tanggal Lahir (gunakan checkdate)
    if (empty($_POST["tgl_lahir"])) {
        $errors["tgl_lahir"] = "Tanggal lahir wajib diisi";
    } else {
        $tgl = explode("-", $_POST["tgl_lahir"]);
        if (count($tgl) == 3) {
            if (!checkdate($tgl[1], $tgl[2], $tgl[0])) {
                $errors["tgl_lahir"] = "Tanggal lahir tidak valid";
            }
        }
    }

    // Validasi IPK (angka antara 0.00 - 4.00)
    if (empty($_POST["ipk"])) {
        $errors["ipk"] = "IPK wajib diisi";
    } elseif (!is_numeric($_POST["ipk"]) || $_POST["ipk"] < 0 || $_POST["ipk"] > 4) {
        $errors["ipk"] = "IPK harus antara 0.00 - 4.00";
    }

    // Validasi Password
    if (empty($_POST["password"])) {
        $errors["password"] = "Password wajib diisi";
    } elseif (strlen($_POST["password"]) < 8) {
        $errors["password"] = "Password minimal 8 karakter";
    }

    // Jika tidak ada error
    if (empty($errors)) {
        echo "<h2>Data Mahasiswa Valid ✅</h2>";
        echo "<p><b>Nama:</b> " . htmlspecialchars($_POST["nama"]) . "</p>";
        echo "<p><b>NIM:</b> " . htmlspecialchars($_POST["nim"]) . "</p>";
        echo "<p><b>Email:</b> " . htmlspecialchars($_POST["email"]) . "</p>";
        echo "<p><b>Tanggal Lahir:</b> " . htmlspecialchars($_POST["tgl_lahir"]) . "</p>";
        echo "<p><b>IPK:</b> " . htmlspecialchars($_POST["ipk"]) . "</p>";
        exit;
    }
}
?>

<!-- Tampilan Form -->
<h2>Form Input Data Mahasiswa</h2>
<form method="post" action="">
    Nama: <input type="text" name="nama" value="<?php echo $_POST['nama'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errors['nama'] ?? ''; ?></span><br><br>

    NIM: <input type="text" name="nim" value="<?php echo $_POST['nim'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errors['nim'] ?? ''; ?></span><br><br>

    Email: <input type="text" name="email" value="<?php echo $_POST['email'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errors['email'] ?? ''; ?></span><br><br>

    Tanggal Lahir: <input type="date" name="tgl_lahir" value="<?php echo $_POST['tgl_lahir'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errors['tgl_lahir'] ?? ''; ?></span><br><br>

    IPK: <input type="text" name="ipk" value="<?php echo $_POST['ipk'] ?? ''; ?>">
    <span style="color:red;"><?php echo $errors['ipk'] ?? ''; ?></span><br><br>

    Password: <input type="password" name="password">
    <span style="color:red;"><?php echo $errors['password'] ?? ''; ?></span><br><br>

    <input type="submit" value="Kirim">
</form>
