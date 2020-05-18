<!--
    Clase Prestamo
-->

<?php
    require_once('DBAbstractModel.php');

    class Prestamo extends DBAbstractModel{
        private static $instancia;

        private $id;
        private $id_usuario;
        private $id_libro;
        private $fecha_prestamo;
        private $fecha_devolucion;

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