<?php 
    $fruits = array("Avocado", "Blueberry", "Cherry"); 

    // 3.1.1
    array_push($fruits, "Banana", "Apple", "Watermelon", "Mango", "Papaya"); 
    echo "I like " . $fruits[0] . ", " . $fruits[1] . ", " . $fruits[2] . ", " . $fruits[3] . ", " . $fruits[4] . ", " . $fruits[5] . ", " . $fruits[6] . " and " . $fruits[7] . ".<br>"; 

    $nilaiTertinggi = count($fruits) - 1; 
    echo "Nilai dengan indeks tertinggi: " . $fruits[$nilaiTertinggi] . "<br>";
    echo "Indeks Tertinggi: $nilaiTertinggi";

    // 3.1.2
    $keyToRemove = array_search("Cherry", $fruits);
    if ($keyToRemove !== false) {
        unset($fruits[$keyToRemove]);
    }
    echo "<br>";

    $nilaiTertinggi = count($fruits) - 1; 
    echo "Nilai dengan indeks tertinggi: " . $fruits[$nilaiTertinggi] . "<br>";
    echo "Indeks Tertinggi: $nilaiTertinggi";
    
    // 3.1.3
    $veggies = array("Carrot", "Broccoli", "Spinach"); 

    echo "<br>Vegetables:<br>";
    foreach ($veggies as $veggie) {
        echo $veggie . "<br>";
    }
?>
