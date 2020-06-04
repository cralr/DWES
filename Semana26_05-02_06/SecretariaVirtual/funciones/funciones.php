<?php

    function limpiarDatos($limpiar){
        $error = trim($limpiar);
        $error = stripslashes($limpiar);
        $error =  htmlspecialchars($limpiar);
        return $error;
    }

    function cerrarSesion(){
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header("Location:index.php");
    }

    function getLetra($valor){
        switch ($valor) {
            case 0:
                return 'a';
            case 1:
                return 'b';
            case 2:
                return 'c';
            case 3:
                return 'd';
            case 4:
                return 'e';
            case 5:
                return 'f';
            case 6:
                return 'g';
            case 7:
                return 'h';
        }
    }
 
?>