<!-- 
    Función esPrimo
-->

<?php

    function esPrimo($num){
        $contador=0;
        $x=1;
        while ($x <= $num){
            if($num % $x == 0){
                $contador++;  
            }
            $x++;
        }
        if ($contador == 2){
            return $num;
        }else{
            return null;
        }
    }
?>