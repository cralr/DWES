<?php

    include "funciones/funciones.php";
    
    session_start();

    if (!isset($_SESSION["logged"])){
        $_SESSION["logged"] = false;
        $_SESSION["usuario"] = "invitado";
        $_SESSION["perfil"] = "invitado";
    }


    if (isset($_POST["login"])){
        $user = $_POST["usuario"];
        $password = $_POST["pass"];
        
        if (login($user,$password)){
            $_SESSION["logged"] = true;
            $_SESSION["usuario"] = $user;
            $_SESSION["perfil"] = "admin";
        }

        $fichero = fopen("./fichero/usuarios.txt","r");
        do{
            $linea = explode(" ", fgets($fichero));
            if($_POST["usuario"] == trim($linea[0]) && $_POST["pass"] == trim($linea[1])){
                header("Location: privado.php");
                $_SESSION["perfil"] = "registrado";
            }
        }while(!feof($fichero)); 
    }

    if(isset($_POST["registrar"])){
    
        $usuarioNuevo = $_POST["usuarioRe"];
        $passNueva = $_POST["passRe"];
        $fichero = fopen("./fichero/usuarios.txt","r+");
        do{
            $linea = explode(" ", fgets($fichero));
        }while(!feof($fichero));
        $linea = fgets($fichero);
        fwrite($fichero,"$usuarioNuevo $passNueva"."\n");
        fclose($fichero);
        $_SESSION["logged"] = true;
    }

?>