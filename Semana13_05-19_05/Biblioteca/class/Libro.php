<!--
    Clase Libro
-->

<?php
    require_once('DBAbstractModel.php');

    class Libro extends DBAbstractModel{
        private static $instancia;

        private $id;
        private $autor;
        private $titulo;
        private $editorial;

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

        public function set($user_data=array()) {
             
                    
                    $this->query = "INSERT INTO bib_libros
                                    (id, titulo, autor)
                                    VALUES
                                    (:id, :titulo, :autor)";
                    $this->parametros['id']= $user_data['id'];
                    $this->parametros['titulo']= $user_data['titulo'];
                    $this->parametros['autor']=$user_data['autor'];
                    $this->get_results_from_query();
                    //$this->execute_single_query();
                    $this->mensaje = 'Usuario agregado exitosamente';
        }


        
    }

?>