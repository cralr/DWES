<?php

    //Función Ejercicio 1
    function sumaElementosVector($array){
        if (count($array) <= 1){
            return $array[0];
        }else{
            $vector = array_pop($array);
            return $vector + sumaElementosVector($array);
        } 
    }

?>