<form method="post" action="form.php">
    <label>Surname:</label><br>
    <input type="text" name="surname"
           value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>"><br><br>

    <label>Email:</label><br>
    <input type="text" name="email"
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <input type="submit" value="Submit">
</form>
