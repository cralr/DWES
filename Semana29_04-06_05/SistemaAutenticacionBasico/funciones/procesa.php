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
            header('Location: index.php');
        } 
        elseif (isset($_POST["usuario"]) && isset($_POST["pass"])){
            if(!empty($_POST["usuario"]) || !empty($_POST["pass"])){
                $db=conectaDB();
                $usuario = error($_POST['usuario']);
                $contraseña = error($_POST['pass']);
                $consulta = "SELECT user, pass FROM usuarios 
                            WHERE user='".$_POST["usuario"]."' AND pass='".$_POST["pass"]."'";
                $result = $db -> prepare($consulta);
                $result -> execute(array($usuario,$pass));
                
                if($result){
                    $_SESSION["perfil"] = "registrado";
                    header('Location: privado.php');
                }  
            }
        }  
    }

    if(isset($_POST["registrar"])){
    
        if(isset($_POST['usuarioRe']) && isset($_POST['passRe'])){
            $db = conectaDB();
            $usuario = error($_POST['usuarioRe']);
            $contraseña = error($_POST['passRe']);
        
            $consulta = 'INSERT INTO usuarios (user,pass)
                        VALUES (?,?)';
    
            $result = $db -> prepare($consulta);
            $result -> execute(array($usuario,$contraseña));
        
            if($result){
                echo "Registro Creado Correctamente.";
                echo "<br>";
            }
            else{
                echo "No se ha creado la consulta correctamente.";
                echo "<br>";
            }
        }
        $_SESSION["logged"] = true;
    }

?>