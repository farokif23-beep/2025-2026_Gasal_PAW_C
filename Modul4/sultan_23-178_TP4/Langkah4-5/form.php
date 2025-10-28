<?php
// Langkah #4–#5
$errors = array();

if (isset($_POST['surname'])) {
    /** @noinspection PhpUndefinedFunctionInspection */
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');

    if ($errors) {
        echo '<h3>Error:</h3>';
        foreach ($errors as $field => $error)
            echo "$field : $error<br>";
    } else {
        echo '<h3>Data OK!</h3>';
    }
} else {
    include 'form.inc';
}
?>
