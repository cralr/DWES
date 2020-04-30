<!--
    Funciones para ejercicios básicos
-->


<?php

    //Ejercicio 1

    function sumaDigitos($num){
        if($num == 0){
            return 0;
        }else{
            return sumaDigitos($num/10) + ($num%10);
        }
    }

    //Ejercicio 2


    

    //Ejercicio 3

    function crearCarta(){
        $ficheroLista = fopen("./carta_lista/lista.txt", "r");
        $arrayUsuarios = array();

        do{
            $linea = fgets($ficheroLista);
            $contenido = explode(" ",$linea);
            array_push($arrayUsuarios, array($contenido[0], $contenido[1]));
        
        }while (!feof($ficheroLista));
        fclose($ficheroLista);

        $contador = 1;

        foreach ($arrayUsuarios as $key => $valor){
            
            $ficheroCarta = fopen("./carta_lista/carta.txt", "r");
            $file = fopen("carta".$contador.".txt", "w");

            do{
                $linea = fgets($ficheroCarta);
                $nombre = str_replace("{nombre}", $valor[0], $linea);
                $direccion = str_replace("{direccion}", $valor[1], $nombre);
                
                fwrite($file ,$direccion);

            }while(!feof($ficheroCarta));
            $contador++;
            fclose($file);
            fclose($ficheroCarta);
        }
    }

?>