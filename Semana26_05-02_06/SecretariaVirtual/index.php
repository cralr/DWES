<?php
	include ("./config/parameters.php");
    include ("./config/config_dev.php");
    include ("./funciones/funciones.php");
    include ("./class/Usuario.php");
    include ("./class/Documento.php");
    include ("./class/Clave.php");
    include ("./class/phpmailer/class.phpmailer.php");

	session_start();

	if (!isset($_SESSION["perfil"])){
        $_SESSION["user"] = Usuario::getInstancia();
        $_SESSION["documento"] = Documento::getInstancia();
        $_SESSION["clave"] = Clave::getInstancia();
        $_SESSION["perfil"] = "invitado";
        $_SESSION["mensaje"] = "";
        $_SESSION["estado"] = "pendiente";
    }

    if(isset($_POST["salir"])){
        cerrarSesion();
    }
    
	if (isset($_POST["login"])){
        $array = $_SESSION["user"]->get($_POST["user"]);

        if(sizeof($array) == 1 && $array[0]['pass'] == $_POST['pass']){
            $_SESSION["id_usuario"] = $array[0]['id'];
            $_SESSION["directorio"] = $array[0]['directorio'];
            $_SESSION["usuario"] = $array[0]['usuario'];
            $_SESSION['perfil'] = $array[0]['perfil'];
            $_SESSION["estado"] = $array[0]['estado'];
            
            if ($_SESSION["perfil"] == "admin") {
                header("Location:index.php?page=admin");
            }   
            if ($_SESSION["perfil"] == "registrado") {
                header("Location:index.php?page=registrado");
            }         
        }
    }
    
    /* if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !=="admin") || ($_SESSION["perfil"] !=="registrado")){
        header("Location: index.php");
    } */
?>

<!DOCTYPE html>
	<head>
		<title><?php echo $TITULO ?></title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/normalize.css">
    	<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
            <?php include "include/cabecera.php"; ?>
		</header>

        <div class="contenedor">

            <div class="login">
                <?php 
                    if ($_SESSION["perfil"] == "invitado"){ 
                        include "include/login.php";               
                    }else{
                        include "include/logout.php";
                    } 
                ?>
            </div>
            <main>
                <?php
                    if (isset($_GET["page"])){
                        if (($_GET["page"]=="index")) {
                            header("Location: index.php");
                        }
                        if (($_GET["page"]=="admin")) {
                            include ("./page/admin.php"); 
                        }
                        if (($_GET["page"]=="registrado")) {
                            include ("./page/usuario_registrado.php"); 
                        }
                        if (($_GET["page"]=="registro")) {
                            include ("./page/registro.php"); 
                        }
                    }else{
                        include ("./page/home.php");
                    }
                ?>
            </main>
        </div>
        
		<footer>
            <?php include "include/footer.php";?>         
		</footer>
</html>