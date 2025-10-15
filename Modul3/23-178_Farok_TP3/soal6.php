<?php 
    // 3.6.1  array_push 
    $arr = [1, 2, 3]; 
    array_push($arr, 4, 5);   
    print_r($arr);   
    echo "<br>"; 
    
    // 3.6.2  array_merge 
    $arr1 = [1, 2, 3]; 
    $arr2 = [4, 5, 6]; 
    $result = array_merge($arr1, $arr2);   
    print_r($result);   
    echo "<br>"; 
    
    // 3.6.3 array_values  
    $arr = ['a' => 'apple', 'b' => 'banana', 'c' => 'cherry']; 
    $result = array_values($arr);   
    print_r($result);  
    echo "<br>"; 
    
    //  3.6.4  array_search 
    $arr = ['apple', 'banana', 'cherry']; 
    $key = array_search('banana', $arr);   
    echo $key;  
    echo "<br>"; 
    
    // 3.6.5 array_filter 
    $arr = [1, 2, 3, 4, 5]; 
    $result = array_filter($arr, function($value) { 
        return $value % 2 === 0;  
    }); 
    print_r($result);   
    echo "<br>"; 
    
    
    // 3.6.6 function sorting  
    // sort() 
    $arr1 = [3, 1, 4, 1, 5]; 
    sort($arr1); 
    print_r($arr1);   
    echo "<br>"; 
    
    // rsort() 
    $arr2 = [3, 1, 4, 1, 5]; 
    rsort($arr2); 
    print_r($arr2);   
    echo "<br>"; 
    
    // asort() 
    $arr3 = ['b' => 3, 'a' => 1, 'c' => 4]; 
    asort($arr3); 
    print_r($arr3);   
    echo "<br>"; 
    // arsort 
    $arr4 = ['b' => 3, 'a' => 1, 'c' => 4]; 
    arsort($arr4); 
    print_r($arr4);   
    echo "<br>"; 
    // ksort 
    $arr5 = ['b' => 3, 'a' => 1, 'c' => 4]; 
    ksort($arr5); 
    print_r($arr5);  
    echo "<br>"; 
    // krsort 
    $arr6 = ['b' => 3, 'a' => 1, 'c' => 4]; 
    krsort($arr6); 
    print_r($arr6);   
?>