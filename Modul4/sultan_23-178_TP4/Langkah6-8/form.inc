<!-- Langkah #7–#8 -->
<form method="post" action="form.php">
    <label>Surname:</label>
    <input type="text" name="surname"
           value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
    <input type="submit" value="Kirim">
</form>
