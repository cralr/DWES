<?php
    $admin = array(
        array(
            "enlace" => "index.php",
            "name" => "Inicio"
        ),

        array(
            "enlace" => "page/admin_libros.php",
            "name" => "Libros"
        ),

        array(
            "enlace" => "page/admin_usuarios.php",
            "name" => "Usuarios"
        ),

        array(
            "enlace" => "page/admin_prestamos.php",
            "name" => "Préstamos"
        ),

    ); 

    $lector = array(
        array(
            "enlace" => "index.php",
            "name" => "Inicio"
        ),

        array(
            "enlace" => "page/lector_libros.php",
            "name" => "Libros"
        ),

        array(
            "enlace" => "page/lector_prestamos.php",
            "name" => "Reservas"
        ),

        array(
            "enlace" => "page/lector_perfil.php",
            "name" => "Perfil"
        ),
    );

    if($_SESSION['perfil'] == "admin"){

        echo "<ul>";
        foreach ($admin as $value){
            echo "<li><a href=".$value['enlace'].">".$value['name']."</a></li>";
        }
        echo "</ul>";
    }

    elseif($_SESSION['perfil'] == "lector"){
        echo "<ul>";
        foreach ($lector as $value){
            echo "<li><a href=".$value['enlace'].">".$value['name']."</a></li>";
        }
        echo "</ul>";
    }
?>