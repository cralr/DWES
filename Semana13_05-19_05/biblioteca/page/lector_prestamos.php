<?php
    include "../config/config_dev.php";
    include "../config/parameters.php";
    include "../funciones/funciones.php";
    include "../class/Libro.php";
    include "../class/Prestamo.php";

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
                        echo "Lista de Libros Reservados<br/>";
                        
                        $mostrarLista = $_SESSION["prestamo"]->mostrarPrestamosLector($_SESSION["id_usuario"]);
    
                        
                        echo "<table>";
                        echo "<br/>";
                        echo "<tr><th>Título</th><th>Autor</th><th>Editorial</th></tr>";
                        foreach ($mostrarLista as $value){
                            echo "<tr>";
                                echo "<td>"; 
                                    echo $value['titulo'];
                                echo "</td>";
                                echo "<td>"; 
                                    echo $value['autor'];
                                echo "</td>";
                                echo "<td>"; 
                                    echo $value['editorial'];
                                echo "</td>";
                                echo "<td>"; 
                                echo "<button><a href='lector_libros.php?devolver=".$value["id"]."'>Devolver</a></button>";
                            echo "</td>";
                            echo "</tr>";
                        }    
                        echo "</table>";
                    echo "</div>";
                ?>     
            </main>
        </div>
        
        

		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>