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
        private $prestado;
        private $devuelto;

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


        public function get($usuario='') {
            if($usuario != '') {
                $this->query = "
                    SELECT  usuario, pass, perfil
                    FROM bib_usuarios
                    WHERE usuario = :usuario";
                $this->parametros['usuario']= $usuario;	
                $this->get_results_from_query();
                $this->close_connection();
                $this->mensaje="No existe el usuario";
            }
            else{
                $this->query ="
                        SELECT *
                        FROM bib_usuarios";
                $this->get_results_from_query();
                $this->close_connection();
            }
            return $this->rows;
        }  

        public function set($user_data=array()) {
            
            $this->query = "INSERT INTO bib_prestamos
                            (id_libros,id_usuarios,prestado)
                            VALUES
                            (:id_libros, :id_usuarios,:prestado)";
            $this->parametros['id_libros']= $user_data['id_libros'];
            $this->parametros['id_usuarios']=$user_data['id_usuarios'];
            $this->parametros['prestado']=$user_data['prestado'];
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = ''; 
        }

        public function edit($user_data=array()) {
            
            $this->query = "UPDATE bib_usuarios
                            SET nombre=:nombre,
                                apellidos=:apellidos,
                                dni=:dni,
                                usuario=:usuario,
                                pass=:apellidos,
                                estado=:estado,
                                perfil=:perfil
                            WHERE
                            id = :id";
            $this->parametros['nombre']= $user_data['nombre'];
            $this->parametros['apellidos']=$user_data['apellidos'];
            $this->parametros['dni']=$user_data['dni'];
            $this->parametros['usuario']=$user_data['usuario'];
            $this->parametros['pass']=$user_data['pass'];
            $this->parametros['estado']=$user_data['estado'];
            $this->parametros['perfil']=$user_data['perfil'];
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Usuario modificado exitosamente';
            
        }

        public function delete($id=''){
            $this->query = "
                DELETE FROM bib_usuarios
                WHERE id = :id
                ";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Usuario eliminado';
        }

        public function getPrestamosById($usuario){
            $this->query = "SELECT * FROM bib_prestamos WHERE id_usuarios:usuario
                ";
            $this->parametros['usuario']=$usuario;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

        public function mostrarPrestamosLector($id=''){
            $this->query = "
                SELECT L.* FROM bib_prestamos P,bib_libros L, bib_usuarios U WHERE L.id = P.id_libros AND P.id_usuarios = U.id AND U.id = :id
            ";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }


    }

?>