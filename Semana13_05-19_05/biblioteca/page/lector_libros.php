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

                    
                        //Mostrar Libros

                        echo "Lista de Libros<br/>";

                        $mostrarLista = $_SESSION["libro"]->get();
    
                        
                        echo "<table>";
                        echo "<tr><th>Título</th><th>Autor</th><th>Editorial</th><th>Estado</th></tr>";
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
                                    echo $value['estado'];
                                echo "</td>";
                                echo "<td>"; 
                                echo "<button><a href='lector_libros.php?reservar=".$value["id"]."'>Reservar</a></button>";
                            echo "</td>";
                            echo "</tr>";
                        }    
                        echo "</table>";

                    //Busqueda

                    echo "<div id='busqueda'>";
                        echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
                                echo "Buscar: <input type='text' name='busqueda'>";
                                echo "<input type='submit' value='Buscar' name='buscar'>";
                        echo "</form>";
                    echo "</div>";

                    if (isset($_POST['buscar'])){
                        echo "Libros encontrados:";
                        imprimeLibroLector($_SESSION["libro"]->buscarLibro($_POST["busqueda"]));
                    }

                    //Reserva de libros

                    if (isset($_GET['reservar'])){
                        if($_SESSION["libro"]->getEstado($_GET['reservar'])[0]['estado']=="disponible"){
                            $array = array(
                                'id_libros'=> $_GET["reservar"],
                                'id_usuarios'=>$_SESSION["id_usuario"],
                                'prestado'=>date("Y-m-d")
                            );
                            $_SESSION["prestamo"]->set($array);

                            $libro_reservado = array(
                                'id'=> $_GET["reservar"],
                                'estado' => "reservado"
                            );
                            $_SESSION["libro"]->cambiarEstado($libro_reservado);
                        }
                        else{
                            echo "No se puede reservar";
                        } 
                    }

                ?>     
            </main>
        </div>
        
        

		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>