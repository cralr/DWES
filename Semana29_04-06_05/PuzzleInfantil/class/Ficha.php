<?php
class Ficha{
    private $_imagen;
    private $_puzle;
    private $_posicion;

    public function __construct($numeroPuzle,$posicion,$imagen){
        $this ->_imagen = $imagen;
        $this ->_puzle = $numeroPuzle;
        $this ->_posicion = $posicion;
    }

    public function getImagen(){
        return $this ->_imagen;
    }    

    public function getPuzle(){
        return $this ->_puzle;
    }
    
    public function getPosicion(){
        return $this ->_posicion;
    }

}

?>