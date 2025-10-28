<?php
// REGEX
$name = "Farok";
if (preg_match("/^[a-zA-Z'-]+$/", $name))
    echo "Nama valid<br>";
else
    echo "Nama tidak valid<br>";

// STRING
$email = "   FAROK@GMAIL.COM   ";
$email = trim(strtolower($email)); // hapus spasi dan ubah ke huruf kecil
echo "Email setelah diproses: $email<br>";

// FILTER
$url = "https://www.example.com";
if (filter_var($url, FILTER_VALIDATE_URL))
    echo "URL valid<br>";
else
    echo "URL tidak valid<br>";

// TYPE TESTING
$nilai = "123";
if (is_numeric($nilai))
    echo "Nilai numerik<br>";

// DATE
if (checkdate(2, 29, 2025))
    echo "Tanggal valid<br>";
else
    echo "Tanggal tidak valid (29 Februari 2025 tidak ada)<br>";
?>
