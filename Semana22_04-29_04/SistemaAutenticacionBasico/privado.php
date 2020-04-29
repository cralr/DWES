<?php
    session_start();
    if( $_SESSION["perfil"] == "registrado"){
        echo "El lado oscuro de la luna.";
    }else
        header("Location: index.php");
?>