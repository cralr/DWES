<?php
    include "../funciones/funciones.php";
    include "../config/parameters.php";
    include "../class/Libro.php";
    include "../config/config_dev.php";

    session_start();

    if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !="admin")){
        header("Location: ../index.php");
    }

    if(!isset($_SESSION["libro"])){
        $_SESSION["libro"] = Libro::getInstancia();
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

                echo "Añadir Libro";    
                    
                echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
                echo "Titulo: <input type=\"text\" name=\"titulo\" ><br/>";
                echo "Autor: <input type=\"text\" name=\"autor\" ><br/>";
                echo "Editorial: <input type=\"text\" name=\"editorial\"><br/>";
                echo "<input type=\"submit\" value=\"Enviar\" name=\"enviar\">";
                echo "</form>"; 

                if (isset($_POST['enviar'])) {

                    $book_data = array('titulo'=>limpiarDatos($_POST['titulo']),
                                        'autor'=>limpiarDatos($_POST['autor']),
                                        'editorial'=>limpiarDatos($_POST['editorial']),
                                        'estado' =>"disponible"
                    );
                    
                    $_SESSION["libro"]->set($book_data);
    
                }
                echo "</div>";
            ?>    
            </main>
        </div>
        
        

		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>
