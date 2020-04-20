<!-- 
    Clase DNI
-->

<?php

class Dni{
    private $_dni;
    private $_mensaje;

    public function __construct($dni){
        $this->_dni = $this->dniValido($dni);
    }

    private function dniValido($dni){
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
            $this->_mensaje="El dni $dni es un dni válido.";
            return $dni;
        }else{
            $this->_mensaje="El dni $dni no es un dni válido.";
            return null;
        }
      
    }

    public function getMensaje(){
        return $this->_mensaje;
    }

}

?>