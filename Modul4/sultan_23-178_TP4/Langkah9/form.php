<?php
$errors = array();

if (isset($_POST['surname'])) {
    require 'validate.inc';

    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'password');

    if ($errors) {
        echo '<h2>Invalid, correct the following errors:</h2>';
        foreach ($errors as $field => $error)
            echo "$field : $error<br>";
        include 'form.inc';
    } else {
        echo '<h2>Form submitted successfully with no errors!</h2>';
        echo '<p><b>Surname:</b> ' . htmlspecialchars($_POST['surname']) . '</p>';
        echo '<p><b>Email:</b> ' . htmlspecialchars($_POST['email']) . '</p>';
    }
} else {
    include 'form.inc';
}
?>
