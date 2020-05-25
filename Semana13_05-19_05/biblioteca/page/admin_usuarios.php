<?php
    include "../config/config_dev.php";
    include "../config/parameters.php";
    include "../funciones/funciones.php";
    include "../class/Usuario.php";

    session_start();

    if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !=="admin")){
        header("Location: ../index.php");
    }
    
    if(!isset($_SESSION["user"])){
        $_SESSION["user"] = Usuario::getInstancia();
        $_SESSION["mensaje"] = "";
    }

    if($_SESSION["mensaje"]!==""){
        echo $_SESSION["mensaje"];
        $_SESSION["mensaje"] = "";
    }

    if(isset($_POST["salir"])){
        cerrarSesion();
        header("Location:../index.php");
    }
   
?>


<!DOCTYPE html>
	<head>
		<title><?php echo $TITULO ?></title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../css/normalize.css">
    	<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<header>
            <?php include "../include/cabecera.php"; ?>
		</header>

        <div class="contenedor">

            <div class="login">
                <?php 
                    if ($_SESSION["perfil"] == "invitado"){ 
                        include "../include/login.php"; 
                    }else
                        include "../include/logout.php"; 
                ?>
            </div>

            <div class="navegacion">
                <nav>
                    <?php 
                        include "../include/nav_page.php";
                    ?>
                </nav>
            </div>

            <main>
            <?php
                echo "<div class='mostrarInfo'>"; 

                     //Mostrar usuarios

                     echo "Lista de Usuarios<br/>";
                
                     
                     $mostrarLista = $_SESSION["user"]->get();

                    echo "<table>";
                    echo "<tr><th>Usuario</th><th>Nombre</th><th>Apellidos</th><th>Dni</th><th>Perfil</th><th>Estado</th></tr>";
                    foreach ($mostrarLista as $value){
                        echo "<tr>";
                            echo "<td>"; 
                                echo $value['usuario'];
                            echo "</td>";
                            echo "<td>"; 
                                echo $value['nombre'];
                            echo "</td>";
                            echo "<td>"; 
                                echo $value['apellidos'];
                            echo "</td>";
                            echo "<td>"; 
                                echo $value['dni'];
                            echo "</td>";
                            echo "<td>"; 
                                echo $value['perfil'];
                            echo "</td>";
                            echo "<td>"; 
                                echo $value['estado'];
                            echo "</td>";
                            echo "<td>"; 
                                echo "<button><a href='admin_usuarios.php?activar=".$value["id"]."'>Activar</a></button>";
                            echo "</td>";
                            echo "<td>"; 
                                echo "<button><a href='admin_usuarios.php?bloquear=".$value["id"]."'>Bloquear</a></button>";
                            echo "</td>";
                            echo "<td>";
                                echo "<button><a href='admin_usuarios.php?eliminar=".$value["id"]."'>Eliminar</a></button>";
                        echo "</tr>";
                    }    
                    echo "</table>";

                    //Eliminar
                    if(isset($_GET["eliminar"])){
                        $_SESSION["user"]->delete($_GET['eliminar']);
                    }

                    if(isset($_GET["activar"])){
                        $_SESSION["user"]->activarUsuario($_GET['activar']);
                    }

                    if(isset($_GET["bloquear"])){
                        $_SESSION["user"]->bloquearUsuario($_GET['bloquear']);
                    }


                echo "</div>";
            ?>    
            </main>
        </div>
        
        

		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>