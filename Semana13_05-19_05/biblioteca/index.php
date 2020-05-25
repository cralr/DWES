<?php
	include ("config/parameters.php");
    include ("config/config_dev.php");
    include ("funciones/funciones.php");
    include ("class/Usuario.php");
    include ("class/Libro.php");
    include ("class/Prestamo.php");

	session_start();

	if (!isset($_SESSION["perfil"])){
        $_SESSION["user"] = Usuario::getInstancia();
        $_SESSION["libro"] = Libro::getInstancia();
        $_SESSION["prestamo"] = Prestamo::getInstancia();
        $_SESSION["id_usuario"] = NULL;
        $_SESSION["perfil"] = "invitado";
        $_SESSION["mensaje"] = "";
        $_SESSION["estado"]=NULL;
    }

    if(isset($_POST["salir"])){
        cerrarSesion();
        header("Location:index.php");
    }
    
   /*  if($_SESSION["mensaje"]!==""){
        echo $_SESSION["mensaje"];
        $_SESSION["mensaje"] = "";
    } */
	
	if (isset($_POST["login"])){
        $array = $_SESSION["user"]->get($_POST["user"]);

       
        if(sizeof($array) == 1 && $array[0]['pass'] == $_POST['pass']){
            $_SESSION['perfil'] = $array[0]['perfil'];
            $_SESSION["id_usuario"] = $array[0]['id'];
            $_SESSION["estado"]=$array[0]['estado'];
        } else{
            //echo $_SESSION["user"]->getMensaje();
        }
    }

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

            <div class="navegacion">
                <nav>
                    <?php 
                    include "include/nav_index.php"
                    ?>
                </nav>
            </div>
            
            <div class="bloqueado">
                <?php
                    if($_SESSION["estado"] == "bloqueado"){
                        echo "<img src='imagenes/bloqueado.png'>";
                    }
                ?>
            </div>

            <main>
                
            </main>
        </div>
        
        

		<footer>
            <?php include "include/footer.php";?>         
		</footer>
</html>