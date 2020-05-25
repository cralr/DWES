<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
    echo " Ha iniciado sesion como: ".$_SESSION["perfil"];
    echo "<input type='submit' name='salir' value='Salir'>";
    echo "</form>";
?>