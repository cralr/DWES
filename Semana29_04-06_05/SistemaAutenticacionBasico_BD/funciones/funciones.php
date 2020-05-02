<?php

    define("USUARIO","root");
    define("CONTRASEÑA","");

    function login($user, $password) {
        return ($user == "admin" and $password == "admin");
    }

    function conectaDB(){
        try{
            $db = new PDO('mysql:host=localhost;dbname=sistema_aut;charset=utf8',USUARIO,CONTRASEÑA);
            $db -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);

            return ($db);
        }
        catch(PDOException $e){
            echo "Error";
            exit();
        }
    }

    function error($limpiar){
        $error = trim($limpiar);
        $error = stripslashes($limpiar);
        $error =  htmlspecialchars($limpiar);
        return $error;
    }

?>