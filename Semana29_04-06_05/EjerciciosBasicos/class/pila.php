<?php

    class Pila{

        private $_arrayElementos = array();

        public function __construct(){
        }

        public function introducirElemento($elementos){
            array_unshift($this->_arrayElementos,$elementos);
        }

        public function sacarElemento(){
            array_shift($this->_arrayElementos);
        }
    
        public function imprimirPila(){
            foreach ($this->_arrayElementos as $key => $value){
                echo $value."<br>";
            }
        }
    }

?>