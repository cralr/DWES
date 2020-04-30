<?php
    session_start();
    if( $_SESSION["perfil"] == "registrado"){
        echo "El lado oscuro de la luna.<br/>";
        echo "<a href=\"logout.php\">Cerrar sesión</a>";
    }else
        header("Location: index.php");
?>