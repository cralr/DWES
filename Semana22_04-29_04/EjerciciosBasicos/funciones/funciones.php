<?php

    //Función Ejercicio 1

    function numRomanoToArabigo($romano){

        $numerosRomanos = array('I' => 1,
                                'V' => 5,
                                'X' => 10,
                                'L' => 50, 
                                'C' => 100,
                                'D' => 500,
                                'M' => 1000,
        );

        $romano = strtoupper($romano);
        $lenght = strlen($romano);
        $contador = 0;
        $resultado = 0;
        while ($contador < $lenght){
            if (($contador + 1 < $lenght) && $numerosRomanos[$romano[$contador]] < $numerosRomanos[$romano[$contador + 1]]){
                $resultado += $numerosRomanos[$romano[$contador + 1]] - $numerosRomanos[$romano[$contador]];
                $contador += 2;
            }else{
                $resultado += $numerosRomanos[$romano[$contador]];
                $contador++;
            }
        }
        return $resultado;
    }

    //Funciones Ejercicio 2

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


    //Función Ejercicio 3

    function comprobarMatriz(){
        $comprobacion = true;
        for ($i=0; $i < count($_POST["valores"]); $i++) { 
          for ($j=0; $j < count($_POST["valores"]); $j++) {
            if ($_POST["valores"][$i][$j] != $_POST["valores"][$j][$i]) {
              $comprobacion = false;
            } 
          }
        }
      
        if ($comprobacion) {
          echo "<p>La matriz es simétrica</p>";
        }else {
          echo "<p>La matriz no es simétrica</p>";
        }
    }

?>