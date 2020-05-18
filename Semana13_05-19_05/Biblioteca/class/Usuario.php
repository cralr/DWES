<!--
    Clase Usuario
-->

<?php
    require_once('DBAbstractModel.php');

    class Usuario extends DBAbstractModel{
        private static $instancia;

        private $id;
        private $nombre;
        private $apellido;
        private $dni;
        private $usuario;
        private $password;
        private $estado;
        private $perfil;

        public static function singleton() {
            if (!isset(self::$instancia)) {
                $miClase = __CLASS__;
                self::$instancia = new $miClase;
            }
            return self::$instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }


        
    }

?>