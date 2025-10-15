<?php
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

    // 3.4.1
    $height["David"] = "180";
    $height["Eva"] = "162";
    $height["Frank"] = "175";
    $height["Grace"] = "168";
    $height["Hannah"] = "158";

    foreach ($height as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }

    // 3.4.2
    $weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

    $weightLength = count($weight);

    for ($i = 0; $i < $weightLength; $i++) {
        $key = array_keys($weight)[$i];
        echo "Key=" . $key . ", Value=" . $weight[$key];
        echo "<br>";
    }
?>
