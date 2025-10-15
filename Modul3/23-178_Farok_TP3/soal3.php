<?php 
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
    echo "Andy is " . $height['Andy'] . " cm tall.<br>";

    // 3.3.1
    $height["David"] = "180";
    $height["Eva"] = "162";
    $height["Frank"] = "175";
    $height["Grace"] = "168";
    $height["Hannah"] = "158";

    $arrlength = count($height);
    
    $lastIndex = array_keys($height)[$arrlength - 1]; // Mendapatkan kunci indeks terakhir
    echo "The height of " . $lastIndex . " is " . $height[$lastIndex] . " cm.<br>";

    // 3.3.2
    unset($height["Charlie"]);

    $arrlength = count($height);

    $lastIndex = array_keys($height)[$arrlength - 1]; 
    echo "After deletion, the height of " . $lastIndex . " is " . $height[$lastIndex] . " cm.<br>";

    // 3.3.3
    $weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

    $secondWeight = array_keys($weight)[1];
    echo "The weight of " . $secondWeight . " is " . $weight[$secondWeight] . " kg.";
?>