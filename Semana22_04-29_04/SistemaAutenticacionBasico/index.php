<!--
Escenario de funcionamiento.

El usuario administrador cuyas credenciales serán 'admin', 'admin' será responsable de registrar a los usuarios , de los que se almacena simplemente el nombre de usuario y su contraseña.

Crea en el sistema un script privado.php que muestre el mensaje: "La cara oculta de la luna". Sólo los usuarios registrados podrán acceder a este script.

Al no disponer de bases de datos, deberás trabajar con ficheros que almacenen las credenciales de los usuarios. 

Utiliza un array para que el administrador almacene las credenciales y al terminar la sesión se guarden en un archivo.
-->


<?php

    include "funciones/procesa.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Rafael Miguel Cruz Álvarez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Básico Autenticación</title>
</head>
<body>
    <noscript>
        <h1>Esta p&aacute;gina requiere el uso de JavaScript</h1>
    </noscript>

    <h1>Autentificación Usuarios</h1>

    <?php

    if($_SESSION["logged"]){
        echo "<p><b>Introduce el usuario y contraseña para registrar.</b></p>";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<label for='user'>Usuario</label><br/>";
        echo "<input type='text' name=usuarioRe><br/>";
        echo "<label for='pass'>Contraseña</label><br/>";
        echo "<input type='password' name=passRe><br/><br/>";
        echo "<input type='submit' name='registrar' value='Registrar Usuario'>";
        echo "<a href=\"logout.php\">Cerrar sesión</a>";
        echo "</form>";
    }else{
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<p><b>Iniciar Sesión</b></p>";
        echo "<label for='user'>Usuario</label><br/>";
        echo "<input type='text' name=usuario><br/>";
        echo "<label for='pass'>Contraseña</label><br/>";
        echo "<input type='password' name=pass><br/><br/>";

        echo "<input type='submit' name='login' value='Iniciar Sesión'>";
        echo "</form>";
    }

    echo "<br>";
    echo "<br><a href=https://github.com/cralr/DWES/tree/master/Semana22_04-29_04/SistemaAutenticacionBasico><button>Ver Código</button></a>"; 
    ?>

</body>
</html>


<!--

    $firewall = array("sript.php",{ADMIN})

ejemplo1.php // privado1.php

¿Quién puede ejecutar ejemplo1.php? 

if ($_session['perfil'] != 'USER' and $_session['perfil'!='ADMIN'){
    location:
}

¿Bajo que condiciones se puede ejecutar ejemplo1.php?

-Petición http
-inserta_fila_bd.php
    admin
    Respuesta a envio de formulario. isset($_POST['enviar'])

Seguridad
    -Mismo agente.
    -Mismo token.
    -Mismo IP.

    if !usuario_valido{
        location: index.php
    }
    if !camino_valido
        location: index.php
    if !seguro
        location: index.php
-->