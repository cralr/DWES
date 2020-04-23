<?php


    /* function numRomanoArabigo($num){
        $numRomanos = ['','I','V','X','L','C','D','M'];
        $valorNumeros = [0,1,5,10,50,100,500,1000];

        $num = '';
        $anterior = 0;
        $suma = 0;
        $letra = '';

        for ($i = 0;$i < count($num); $i++){

        }
    } */

    function esPerfecto($num){
        $suma = 0;
        for($i=1; $i < $num; $i++){
            if ($num % $i == 0){
                $suma+=$i;
            }
        }
        if ($suma == $num){
            return true;
        }else
            return false;
    }

   
    function listadoNumerosPerfectos(){
        $perfecto = array();
        $suma=0;

        for ($i=1; $i < 500; $i++) { 
            if (esPerfecto($i)) {
                array_push( $perfecto, $i);
            }
            if (count($perfecto) == 3) {
                break;
            }
        }
    
        echo "Los tres primeros números perfectos son: ";
        foreach ($perfecto as $key => $value) {
            echo $value." ";
        }

        echo "<br/>La suma de los tres primeros números perfectos son: ";
        
        foreach ($perfecto as $key => $value){
            $suma+=$value;
        }

        echo $suma;
    }





?>