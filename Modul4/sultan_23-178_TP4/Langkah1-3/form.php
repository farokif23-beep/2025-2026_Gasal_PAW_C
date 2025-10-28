<!-- Langkah #1–#3 -->
<!-- Ubah file HTML menjadi PHP dan arahkan action ke dirinya sendiri -->

<form method="post" action="form.php">
    <label>Surname:</label>
    <input type="text" name="surname">
    <input type="submit" value="Kirim">
</form>

<?php
// Tes kirim data agar memastikan form tidak error
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<p>Data berhasil dikirim: " . htmlspecialchars($_POST['surname']) . "</p>";
}
?>
