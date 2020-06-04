<!--
    Clase Clave
-->

<?php
    require_once('DBAbstractModel.php');

    class Clave extends DBAbstractModel{
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


       /**
        * Función get 
        */
        public function get($usuario='') {
            if($usuario != '') {
                $this->query = "
                    SELECT  *
                    FROM secre_clavefirma
                    WHERE usuario = :usuario";
                $this->parametros['usuario']= $usuario;	
                $this->get_results_from_query();
                $this->close_connection();
            }
            return $this->rows;
        }

        public function set($idUsuario,$fila,$columna,$valor) {
            
            $this->query = "INSERT INTO secre_clavefirma
                            (idUsuario, fila,columna,valor)
                            VALUES
                            (:idUsuario, :fila,:columna,:valor)";
            $this->parametros['idUsuario']= $idUsuario;
            $this->parametros['fila']=$fila;
            $this->parametros['columna']=$columna;
            $this->parametros['valor']=$valor;
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Usuario agregado exitosamente'; 
        }

        public function getValor($idUsuario,$fila,$columna){
            $this->query = "SELECT valor FROM secre_clavefirma
            WHERE idUsuario =:idUsuario AND fila=:fila AND columna=:columna";
            $this->parametros['idUsuario']= $idUsuario;
            $this->parametros['fila']=$fila;
            $this->parametros['columna']=$columna;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows[0]['valor'];
        }
       
        /*
        public function edit($user_data=array()) {
            $this->query = "UPDATE secre_usuario
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
                DELETE FROM secre_usuario
                WHERE id = :id
                ";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Usuario eliminado';
        }*/
       
    }

?>