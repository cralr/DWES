<!--
    Página admin del ejercicio Biblioteca
-->

<?php
    include "../config/config_dev.php";
    include "../config/parameters.php";
    include "../funciones/funciones.php";
    include "../class/Libro.php";

    session_start();

    if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !=="admin")){
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
                                    echo "<button><a href='admin_libros.php?eliminar=".$value["id"]."'>Eliminar</a></button>
                                    <button><a href='admin_libros.php?editar=".$value["id"]."'>Editar</a></button><br>";
                            echo "</tr>";
                        }    
                        echo "</table>";


                        echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
                            echo "<br/><br/>";
                            echo "Buscar: <input type='text' name='busqueda'>";
                            echo "<input type='submit' value='Buscar' name='buscar'> | <button><a href=../page/annadirLibro.php>Nuevo Libro</a></button>";
                        echo "</form>";

                        //Eliminar
                        if(isset($_GET["eliminar"])){
                            $_SESSION["libro"]->delete($_GET['eliminar']);
                        }

                        //Editar

                        if(isset($_GET["editar"])){
                    
                            $id = $_GET['editar'];
                    
                            $result = $_SESSION["libro"]->get($id);

                            echo "<br/>Editar Libro";
                        
                            echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
                            echo "Titulo: <input type=\"text\" name=\"titulo\" value=".$result[0]['titulo']."><br/>";
                            echo "Autor: <input type=\"text\" name=\"autor\" value=".$result[0]['autor']."><br/>";
                            echo "Editorial: <input type=\"text\" name=\"editorial\" value=".$result[0]['editorial']."><br/>";
                            echo "<input type=\"hidden\" name=\"id\" value=".$result[0]['id'].">";
                            echo "<input type=\"submit\" value=\"Aceptar cambios\" name=\"editar\">";
                            echo "</form>";
                    
                        }
                    
                        if(isset($_POST['editar'])) {
                            
                            $book_data = array(
                                'id'=> $_POST['id'],
                                'titulo'=>limpiarDatos($_POST['titulo']),
                                'autor'=>limpiarDatos($_POST['autor']),
                                'editorial'=>limpiarDatos($_POST['editorial'])
                            );

                            $_SESSION['libro']->edit($book_data);
                        }
                        
                        //Busqueda
                        if (isset($_POST['buscar'])){
                            echo "Libros encontrados:";
                            imprimeLibroLector($_SESSION["libro"]->buscarLibro($_POST["busqueda"]));
                        }

                    echo "</div>";
                ?>     
            </main>
        </div>
        
        

		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>











