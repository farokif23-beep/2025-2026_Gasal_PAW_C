<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $q = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
    $data = mysqli_fetch_assoc($q);

    if ($data) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Toko</title>

<style>
/* ====== LOGIN PAGE ====== */
body.login-page {
    margin: 0;
    padding: 0;
    height: 100vh;
    font-family: Arial, sans-serif;

    /* Background gradasi */
    background: linear-gradient(135deg, #7f7bff 0%, #9b69ff 100%);
    
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Kotak login */
.login-container {
    width: 100%;
    max-width: 380px;
    background: white;
    padding: 30px 35px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    text-align: center;
}

.login-container h2 {
    margin-bottom: 25px;
    font-size: 26px;
    color: #6a5ae0;
    letter-spacing: 1px;
}

/* Label */
.login-container label {
    text-align: left;
    width: 100%;
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

/* Input */
.login-container input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 2px solid #e0e0e0;
    margin-bottom: 15px;
    transition: 0.3s;
    font-size: 15px;
    background: #f5f6ff;
}

.login-container input:focus {
    border-color: #7f7bff;
    box-shadow: 0 0 0 3px rgba(127, 123, 255, 0.2);
    outline: none;
}

/* Tombol */
.login-container button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #6b63ff 0%, #8b63ff 100%);
    border: none;
    border-radius: 8px;
    font-size: 16px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.login-container button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(130, 111, 255, 0.4);
}

/* Error message */
.error {
    background: #ffdddd;
    border-left: 4px solid #ff4b4b;
    color: #a40000;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    font-size: 14px;
}
</style>

</head>
<body class="login-page">

<div class="login-container">
    <h2>LOGIN</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Masuk</button>
    </form>
</div>

</body>
</html>
