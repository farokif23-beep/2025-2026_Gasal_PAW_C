<?php 
    
    $students = array( 
        array("Alex","220401","0812345678"), 
        array("Bianca","220402","0812345687"), 
        array("Candice","220403","0812345665"), 
    ); 
    
    // 3.5.1 - Replacing the names with Indonesian names 
    array_push($students,  
    array("Dedi", "220404", "0812345679"), 
    array("Eka", "220405", "0812345680"), 
    array("Farah", "220406", "0812345681"), 
    array("Gilang", "220407", "0812345682"), 
    array("Hasan", "220408", "0812345683")); 
    
    for ($row = 0; $row <= 7; $row++) { 
        echo "<p><b>Row number $row</b></p>"; 
        echo "<ul>"; 
        for ($col = 0; $col < 3; $col++) { 
            echo "<li>". $students[$row][$col] . "</li>"; 
        } 
        echo "</ul>"; 
    } 
    
    // 3.5.2 - Table structure 
    echo "<table border='2'>"; 
    echo "<tr><th>Nama</th><th>NIM</th><th>Mobile</th></tr>"; 
    for ($row = 0; $row <= 7; $row++) { 
        echo "<tr>"; 
        for ($col = 0; $col < 3; $col++) { 
            echo "<td>". $students[$row][$col] . "<br></td>"; 
        } 
        echo "</tr>"; 
    } 
    echo "</table>"; 
?> 