<!-- 
    Sacar en un array 5 primeros array.
-->

<?php

    include "primo.php";

    function cincoPrimosIniciales(){
        $primos = array();

        for ($i=0; $i < 20; $i++) { 
            if (esPrimo($i)) {
                array_push( $primos, $i);
            }
            if (count($primos) == 5) {
                break;
            }
        }
    
        echo "Los primeros cinco números primos son: ";
        foreach ($primos as $key => $value) {
            echo $value." ";
        }
    }

?>