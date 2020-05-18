<?php

    class Cola{

        private $_arrayElementos = array();

        /* public function __construct($elementos){
            $this->_arrayElementos = $elementos;
        } */

        public function introducirElemento($elementos){
            array_push($this->_arrayElementos,$elementos);
        }

        public function sacarElemento(){
            array_shift($this->_arrayElementos);
        }
    
        public function imprimirCola(){
            foreach ($this->_arrayElementos as $key => $value){
                echo $value."<br>";
            }
        }
    }

?>