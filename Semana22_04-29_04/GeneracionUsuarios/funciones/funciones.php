<?php

    function normaliza($cadena){
        $originales = "ÁáÉéÍíÓóÚúñ";
        $modificadas = "aaeeiioouun";
        $cadena = utf8_decode($cadena);
        $cadena = strtr ($cadena, utf8_decode($originales),$modificadas);
        $cadena = $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }

?>