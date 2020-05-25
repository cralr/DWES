<!--
    Página principal del ejercicio Biblioteca
-->

<?php

    echo "Usted esta logueado como ".$_SESSION['perfil'];
    echo "<form action='./index.php' method='post'>";
        echo "Usuario <input type='text' name='user'>";
        echo "  Contraseña <input type='password' name='pass'>";
        echo "<input type='submit' name='login' value='Enviar'>";
        echo " | <a href=\"page/registro.php\">Registro</a>";
    echo "</form>";
?>



