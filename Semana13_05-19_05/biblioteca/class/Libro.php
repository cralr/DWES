<!--
    Clase Libro
-->

<?php
    require_once('DBAbstractModel.php');

    class Libro extends DBAbstractModel{
        private static $instancia;

        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miClase = __CLASS__;
                self::$instancia = new $miClase;
            }
            return self::$instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }

        public function getMensaje(){
            return $this->mensaje;
        }


        public function get($id='') {
            if($id != '') {
                $this->query = "SELECT  id,titulo, autor , editorial
                    FROM bib_libros
                    WHERE id = :id";
                $this->parametros['id']= $id;	
                $this->get_results_from_query();
                $this->close_connection();
            }
            else{
                $this->query ="SELECT *
                        FROM bib_libros";
                $this->get_results_from_query();
                $this->close_connection();
            }
            return $this->rows;
        } 

        public function set($user_data=array()) {
            
                    $this->query = "INSERT INTO bib_libros
                                    (titulo, autor, editorial,estado)
                                    VALUES
                                    (:titulo, :autor, :editorial, :estado)";
                    $this->parametros['titulo']= $user_data['titulo'];
                    $this->parametros['autor']=$user_data['autor'];
                    $this->parametros['editorial']=$user_data['editorial'];
                    $this->parametros['estado']=$user_data['estado'];
                    $this->get_results_from_query();
                    $this->close_connection();
                    $this->mensaje = 'Libro agregado exitosamente';
                    
        }

        public function edit($user_data=array()) {
            
            $this->query = " UPDATE bib_libros
                            SET titulo=:titulo,
                                autor=:autor,
                                editorial=:editorial
                            WHERE
                            id = :id";
            $this->parametros['id']= $user_data['id'];
            $this->parametros['titulo']= $user_data['titulo'];
            $this->parametros['autor']=$user_data['autor'];
            $this->parametros['editorial']=$user_data['editorial'];
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Libro modificado exitosamente';
            
        }

        public function delete($id=''){
            $this->query = "DELETE FROM bib_libros
                WHERE id = :id
                ";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Libro eliminado';
        }

        //Función Filtrar

        public function buscarLibro($busqueda=''){
            if($busqueda!=''){
                $this->query = "SELECT * FROM bib_libros
                WHERE 
                titulo LIKE :filtro or
                autor LIKE :filtro or
                editorial LIKE :filtro
                ";
                $this->parametros['filtro']="%".$busqueda."%";
            }
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

        //Función Cambiar Estado

        public function cambiarEstado($user_data=array()){
            $this->query = "UPDATE bib_libros SET estado=:estado WHERE id = :id";
            $this->parametros['id']=$user_data["id"];
            $this->parametros['estado']=$user_data["estado"];
            $this->get_results_from_query();
            $this->close_connection();
        }

        public function getEstado($id='') {
            if($id != '') {
                $this->query = "SELECT estado 
                    FROM bib_libros
                    WHERE id = :id";
                $this->parametros['id']= $id;	
                $this->get_results_from_query();
                $this->close_connection();
                return $this->rows;
            }     
        }

    }
?>