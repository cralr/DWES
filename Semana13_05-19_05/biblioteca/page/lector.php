<?php

    if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !="lector")){
        header("Location:../index.php");
    }

    echo "<h1>Sitio del Lector</h1>";

?>