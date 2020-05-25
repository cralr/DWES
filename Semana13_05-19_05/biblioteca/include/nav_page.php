<?php
    $admin = array(
        array(
            "enlace" => "../index.php",
            "name" => "Inicio"
        ),

        array(
            "enlace" => "admin_libros.php",
            "name" => "Libros"
        ),

        array(
            "enlace" => "admin_usuarios.php",
            "name" => "Usuarios"
        ),

        array(
            "enlace" => "admin_prestamos.php",
            "name" => "Préstamos"
        ),

    ); 

    $lector = array(
        array(
            "enlace" => "../index.php",
            "name" => "Inicio"
        ),

        array(
            "enlace" => "lector_libros.php",
            "name" => "Libros"
        ),

        array(
            "enlace" => "lector_prestamos.php",
            "name" => "Reservas"
        ),

        array(
            "enlace" => "lector_perfil.php",
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

    else{
        echo "<ul>";
        foreach ($lector as $value){
            echo "<li><a href=".$value['enlace'].">".$value['name']."</a></li>";
        }
        echo "</ul>";
    }
?>