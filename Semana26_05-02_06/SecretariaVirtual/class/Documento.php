<!--
    Clase Usuario
-->

<?php
    require_once('DBAbstractModel.php');

    class Documento extends DBAbstractModel{
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
        * Funición get para saber si existe o no un documento al crearlo en el registro.
        */
        public function get($documento='') {
            if($documento != '') {
                $this->query = "
                    SELECT  *
                    FROM secre_documentos 
                    WHERE id = :id";
                $this->parametros['id']= $documento;	
                $this->get_results_from_query();
                $this->close_connection();
                $this->mensaje="No existe el documento.";
            }
            return $this->rows;
        }

        /**
         * Función get la cual obtendrá el documento a través de su id
         */ 
        public function getDocumentoById($id, $idUsuario){
            $this->query = "SELECT * FROM secre_documentos WHERE id = :id AND idUsuario=:idUsuario";
            $this->parametros['id']=$id;
            $this->parametros['idUsuario']=$idUsuario;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

        /**
         * Función get la cual obtendrá todo la info de un documento
         */ 
        public function getDocumentosByUser($idUsuario){
            $this->query ="SELECT *
                    FROM secre_documentos
                    WHERE idUsuario=:idUsuario
                    "; 
            $this->parametros['idUsuario']=$idUsuario;  
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

         /**
         * Función get la cual obtendrá todo la info de un documento
         */ 
        public function getDocumento(){
            $this->query ="SELECT *
                    FROM secre_documentos";
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }

        public function firmarDocumento($id,$idUsuario){
            $this->query = "UPDATE secre_documentos
                            SET estado=:estado,
                                fechafirma=:fechaFirma
                            WHERE
                            id = :id AND idUsuario=:idUsuario";
            $this->parametros['id']= $id;
            $this->parametros['idUsuario']=$idUsuario;
            $this->parametros['estado']="firmado";
            $this->parametros['fechaFirma']=date("Y-m-d H:i:s");
            $this->get_results_from_query();
            $this->close_connection();
        }

       /**
        * Funcion set para agregar documentos.
        */
       public function set($user_data=array()) {
            
            $this->query = "INSERT INTO secre_documentos
                            (idUsuario,descripcion,fichero,estado)
                            VALUES
                            (:idUsuario,:descripcion,:fichero,:estado)";

            $this->parametros['idUsuario']= $user_data['idUsuario'];
            $this->parametros['descripcion']= $user_data['descripcion'];
            $this->parametros['fichero']=$user_data['fichero'];
            $this->parametros['estado']=$user_data['estado'];
            $this->get_results_from_query();
            $this->close_connection();
            $this->mensaje = 'Documento agregado exitosamente';
            
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
        
        /**
         * Función usada para la busqueda de usuarios
         */
        public function buscarDocumento($busqueda, $idUsuario){
            $this->query = "SELECT * FROM secre_documentos
            WHERE
            idUsuario = :idUsuario AND 
            descripcion LIKE :filtro or
            estado LIKE :filtro 
            ";
            $this->parametros['filtro']="%".$busqueda."%";
            $this->parametros['idUsuario']= $idUsuario;
            $this->get_results_from_query();
            $this->close_connection();
            return $this->rows;
        }
    }

?>