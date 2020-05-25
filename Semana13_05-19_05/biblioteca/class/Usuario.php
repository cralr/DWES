<!--
    Clase Usuario
-->

<?php
    require_once('DBAbstractModel.php');

    class Usuario extends DBAbstractModel{
        private static $instancia;

        private $id;
        private $nombre;
        private $apellidos;
        private $dni;
        private $usuario;
        private $pass;
        private $estado;
        private $perfil;

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

        public function usuarioExistente($usuario='') {
            if($usuario != '') {
                $this->query = "
                    SELECT  usuario
                    FROM bib_usuarios
                    WHERE usuario = :usuario";
                $this->parametros['usuario']= $usuario;	
                $this->get_results_from_query();
                $this->close_connection();
                $this->mensaje="El usuario ya existe.";
            }
            return $this->rows;
        }  

        public function get($usuario='') {
            if($usuario != '') {
                $this->query = "
                    SELECT  *
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

        public function getUsuarioById($id){
            $this->query = "SELECT * FROM bib_usuarios WHERE id = :id     ";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

        public function set($user_data=array()) {
            
            $this->query = "INSERT INTO bib_usuarios
                            (nombre, apellidos,dni,usuario,pass,estado,perfil)
                            VALUES
                            (:nombre, :apellidos,:dni,:usuario,:pass,:estado,:perfil)";
            $this->parametros['nombre']= $user_data['nombre'];
            $this->parametros['apellidos']=$user_data['apellidos'];
            $this->parametros['dni']=$user_data['dni'];
            $this->parametros['usuario']=$user_data['usuario'];
            $this->parametros['pass']=$user_data['pass'];
            $this->parametros['estado']=$user_data['estado'];
            $this->parametros['perfil']=$user_data['perfil'];
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Usuario agregado exitosamente';
            
        }

        public function edit($user_data=array()) {
            $this->query = "UPDATE bib_usuarios
                            SET nombre=:nombre,
                                apellidos=:apellidos,
                                dni=:dni,
                                usuario=:usuario,
                                pass=:pass
                            WHERE
                            id = :id";
            $this->parametros['nombre']= $user_data['nombre'];
            $this->parametros['apellidos']=$user_data['apellidos'];
            $this->parametros['dni']=$user_data['dni'];
            $this->parametros['usuario']=$user_data['usuario'];
            $this->parametros['pass']=$user_data['pass'];
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

        public function activarUsuario($id=''){
            if($id !=''){
                $this->query = " UPDATE bib_usuarios
                                 SET estado = :estado
                                 WHERE id = :id
                ";
                $this->parametros['estado']="activo";
                $this->parametros['id']=$id;
                $this->get_results_from_query();
                $this->close_connection();
            }
        }

        public function bloquearUsuario($id=''){
            if($id !=''){
                $this->query = " UPDATE bib_usuarios
                                 SET estado = :estado
                                 WHERE id = :id
                ";
                $this->parametros['estado']="bloqueado";
                $this->parametros['id']=$id;
                $this->get_results_from_query();
                $this->close_connection();
            }
        }
        

    }

?>