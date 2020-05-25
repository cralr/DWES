<!--
    Página admin del ejercicio Biblioteca
-->

<?php
    include "../config/config_dev.php";
    include "../config/parameters.php";
    include "../funciones/funciones.php";
    include "../class/Libro.php";
    include "../class/Prestamo.php";
    include "../class/Usuario.php";

    session_start();

    if(!isset($_SESSION["perfil"] ) || $_SESSION["perfil"] !=="lector" || $_SESSION["estado"] !== "activo"){
        header("Location: ../index.php");
    }
    
    /* if(!isset($_SESSION["libro"])){
        $_SESSION["libro"] = Libro::getInstancia();
        $_SESSION["mensaje"] = "";
    } */

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
                    
                        $infoUsuario = $_SESSION['user']->getUsuarioById($_SESSION["id_usuario"]);
                        
                        echo "Nombre: ".$infoUsuario[0]['nombre']."<br/>";
                        echo "Apellidos: ".$infoUsuario[0]['apellidos']."<br/>";
                        echo "DNI: ".$infoUsuario[0]['dni']."<br/>";
                        echo "Usuario: ".$infoUsuario[0]['usuario']."<br/>";
                        echo "Contraseña: ".$infoUsuario[0]['pass']."<br/>";

                        echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
                            echo "<input type='submit' value='Editar' name='ed_user'>";
                            echo "<br/>";
                        echo "</form>";
                        
                        if(isset($_POST["ed_user"])){
        
                            echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
                            echo "Nombre: <input type=\"text\" name=\"nombre\" value=".$infoUsuario[0]['nombre']."><br/>";
                            echo "Apellidos: <input type=\"text\" name=\"apellidos\" value=".$infoUsuario[0]['apellidos']."><br/>";
                            echo "DNI: <input type=\"text\" name=\"dni\" value=".$infoUsuario[0]['dni']."><br/>";
                            echo "Usuario: <input type=\"text\" name=\"usuario\" value=".$infoUsuario[0]['usuario']."><br/>";
                            echo "Contraseña: <input type=\"text\" name=\"pass\" value=".$infoUsuario[0]['pass']."><br/>";
                            echo "<input type=\"hidden\" name=\"id\" value=".$infoUsuario[0]['id'].">";
                            echo "<input type=\"submit\" value=\"Aceptar cambios\" name=\"editar\">";
                            echo "</form>";

                        }
                    
                        if(isset($_POST['editar'])) {
                            
                            $user_data = array(
                                'id'=> $_POST['id'],
                                'nombre'=>limpiarDatos($_POST['nombre']),
                                'apellidos'=>limpiarDatos($_POST['apellidos']),
                                'dni'=>limpiarDatos($_POST['dni']),
                                'usuario'=>limpiarDatos($_POST['usuario']),
                                'pass'=>limpiarDatos($_POST['pass'])
                            );

                            $_SESSION['user']->edit($user_data);
                        }
                    
                    echo "</div>";
                ?>     
            </main>
        </div>
		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>