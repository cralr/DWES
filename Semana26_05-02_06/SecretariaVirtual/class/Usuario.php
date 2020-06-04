<!--
    Clase Usuario
-->

<?php
    require_once('DBAbstractModel.php');
    

    class Usuario extends DBAbstractModel{
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
        * Funición get para saber si existe o no un usuario al crearlo en el registro.
        */
        public function get($usuario='') {
            if($usuario != '') {
                $this->query = "
                    SELECT  *
                    FROM secre_usuario 
                    WHERE usuario = :usuario";
                $this->parametros['usuario']= $usuario;	
                $this->get_results_from_query();
                $this->close_connection();
                $this->mensaje="No existe el usuario.";
            }
            return $this->rows;
        }

        /**
         * Función get la cual obtendrá el usuario a través de su id
         */ 
        public function getUsuarioById($id){
            $this->query = "SELECT * FROM secre_usuario WHERE id = :id ";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

         /**
         * Función get la cual obtendrá todo la info de un usuario
         */ 
        public function getUsuario(){
            $this->query ="SELECT *
                    FROM secre_usuario";
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

         /**
         * Función get la cual obtendrá el nick de un usuario
         */ 
        public function getNick($id=''){
            if($id !=''){
                $this->query = " SELECT usuario
                                 FROM secre_usuario
                                 WHERE id = :id
                ";
                $this->parametros['id']=$id;
                $this->get_results_from_query();
                $this->close_connection();
            }
        }

        public function getDirectorio($id){
            $this->query = "SELECT directorio FROM secre_usuario WHERE id=:id";
            $this->parametros['id']=$id;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }
        
       public function set($user_data=array()) {
            
            $this->query = "INSERT INTO secre_usuario
                            (nombre, apellidos,email,usuario,pass,estado,perfil)
                            VALUES
                            (:nombre, :apellidos,:email,:usuario,:pass,:estado,:perfil)";
            $this->parametros['nombre']= $user_data['nombre'];
            $this->parametros['apellidos']=$user_data['apellidos'];
            $this->parametros['email']=$user_data['email'];
            $this->parametros['usuario']=$user_data['usuario'];
            $this->parametros['pass']=$user_data['pass'];
            $this->parametros['estado']=$user_data['estado'];
            $this->parametros['perfil']=$user_data['perfil'];
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Usuario agregado exitosamente';
            
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

        //Función con consulta para saber si un usuario existe ya en la bd
        public function usuarioExistente($usuario='') {
            if($usuario != '') {
                $this->query = "
                    SELECT  usuario
                    FROM secre_usuario
                    WHERE usuario = :usuario";
                $this->parametros['usuario']= $usuario;	
                $this->get_results_from_query();
                $this->close_connection();
                $this->mensaje="El usuario ya existe.";
            }
            return $this->rows;
        }  
        
        /**
         * Función usada para la busqueda de usuarios
         */
        public function buscarUsuario($busqueda){
            $this->query = "SELECT * FROM secre_usuario
            WHERE 
            nombre LIKE :filtro or
            email LIKE :filtro or
            usuario LIKE :filtro or
            estado LIKE :filtro 
            ";
            $this->parametros['filtro']="%".$busqueda."%";
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

        /**
         * Funcíon para editar campo estado y directorio
         */

        public function cambioEstado($user_data=array()) {
            $this->query = "UPDATE secre_usuario
                            SET estado=:estado,
                                directorio=:directorio
                            WHERE
                            id = :id";
            $this->parametros['estado']= $user_data['estado'];
            $this->parametros['directorio']=$user_data['directorio'];
            $this->get_results_from_query();
            $this->close_connection();
        }

         /**
         * Función usada para activar un usuario
         */ 
        public function activarUsuario($id){
            $user = $this->getUsuarioById($id)[0];
            $directorio = $this->generarDirectorio($user['nombre'],$user['apellidos']);

            
            if(!file_exists("usuario/".$directorio)){
                mkdir("usuario/".$directorio,0777,true);
            }
            
            $arrayDatos = array(
                'id' => $id,
                'estado'=> "activo",
                'directorio' => $directorio
            );

            $this->cambioEstado($arrayDatos);
            $this->enviarCorreo($id);
            $this->mensaje = "Usuario dado de alta correctamente.";
        } 

        /**
         * Función usada para bloquear un usuario
         */ 

        public function bloquearUsuario($id){
            $this->query = " UPDATE secre_usuario
                                 SET estado = :estado,
                                     directorio =:directorio
                                 WHERE id = :id
                ";
                $this->parametros['estado']="bloqueado";
                $this->parametros['directorio']= NULL;
                $this->parametros['id']=$id;
                $this->get_results_from_query();
                $this->close_connection();
                $this->mensaje = "Usuario bloqueado correctamente.";
        } 

        /**
         * Función usada para obtener el correo de un usuario
         */ 

        public function obtenerCorreo($id){
            $this->query = " SELECT email
                            FROM secre_usuario
                            WHERE id = :id
                ";
                $this->parametros['id']=$id;
                $this->get_results_from_query();
                $this->close_connection();
                return $this->rows;
                
        } 

        /**
         * Función para enviar el correo
         */

        public function enviarCorreo($id){
            $mail = new PHPMailer();
            $email = $this->obtenerCorreo($id)[0];

            $mail->CharSet = "utf-8";
            $mail->From = "rafadwes10@gmail.com";
            $mail->FromName = "Administrador Secretaría Virtual";
            $mail->Subject = "Usuario Activado.";

            $mail->addAddress(implode('',$email)," ");
            $mail->msgHTML("Usuario activado correctamente.");

            if($mail->send()){
                $this->mensaje = "Correo con claves enviado.";
            }else
                $this->mensaje = "Correo con claves no enviado.";
        }


        private function generarDirectorio($nombre,$apellidos){
            $user = $apellidos." ".$nombre;

            return substr($this->normaliza(explode(" ",$user)[0]),0,2).
                    substr($this->normaliza(explode(" ",$user)[1]),0,2).
                    substr($this->normaliza(explode(" ",$user)[2]),0,2).date("HmsdmY");

        }

        private function normaliza($cadena){
            $originales = "ÁáÉéÍíÓóÚúñ";
            $modificadas = "aaeeiioouun";
            $cadena = utf8_decode($cadena);
            $cadena = strtr ($cadena, utf8_decode($originales),$modificadas);
            $cadena = $cadena = strtolower($cadena);
            return utf8_encode($cadena);
        }

        public function activarEstadoBloqueado($id){
            $this->query = "UPDATE secre_usuario
                            SET estado=:estado
                            WHERE
                            id = :id";
            $this->parametros['id']= $id;
            $this->parametros['estado']= "activo";
            $this->get_results_from_query();
            $this->close_connection();
        }


    }

?>