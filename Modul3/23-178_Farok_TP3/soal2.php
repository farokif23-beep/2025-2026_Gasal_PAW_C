<?php 
    $fruits = array("Avocado", "Blueberry", "Cherry"); 
    $arrlength = count($fruits); 

    // 3.2.1
    $newFruits = array("Banana", "Apple", "Watermelon", "Mango", "Papaya");
    for ($x = 0; $x < count($newFruits); $x++) {
        $fruits[] = $newFruits[$x]; // Menambahkan data baru ke dalam array
    }

    $arrlength = count($fruits); 
    for ($x = 0; $x < $arrlength; $x++) { 
        echo $fruits[$x]; 
        echo "<br>"; 
    }

    echo "Panjang array \$fruits saat ini: $arrlength<br>";

    // 3.2.2
    $veggies = array("Carrot", "Broccoli", "Spinach");
    
    $veggiesLength = count($veggies);
    for ($y = 0; $y < $veggiesLength; $y++) {
        echo $veggies[$y];
        echo "<br>";
    }
?>