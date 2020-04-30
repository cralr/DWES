<!--

    1. Escribe una función recursiva que sume los dígitos de un número.
    2. Una pila es una estructura de datos a la que se accede siguiendo el siguiente criterio. El primer elemento en entrar es el último elemento en salir. Crea una clase para implementar una pila y haz un script que la utilice.
    3. Crea un archivo de texto llamado CARTA y otro con nombres y direcciones llamado LISTA. Escribe un programa para enviar cartas personalizadas a cada una de las personas del archivo LISTA. En el fichero CARTA aparecerá marcado con llaves el texto que debe ser reemplazado. Por ejemplo, Estimado,a {nombre}
-->

<?php

    include "funciones/funciones.php";
    include "class/pila.php";
    
    session_start();

    //Ejercicio 1

    $mensaje = "";

    if(isset($_POST['enviar'])){
        if (isset($_POST["num"]) && ($_POST['num'] != "")){
           $mensaje =  "La suma de los dígitos del número ".$_POST["num"]." es " .sumaDigitos($_POST["num"])."." ;
        }
    }

    //Ejercicio 2

    if(!isset($_SESSION["pila"])){
        $_SESSION["pila"] = new Pila();
    }


    if(isset($_POST['in'])){
        if (isset($_POST["elemento"]) && ($_POST['elemento'] != "")){
           $_SESSION["pila"]->introducirElemento($_POST['elemento']);  
        }
    }
    
    if(isset($_POST['out'])){
        $_SESSION["pila"]->sacarElemento();  
    }   
    
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Rafael Miguel Cruz Álvarez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicios Básicos Semana 3</title>
</head>
<body>
    <noscript>
        <h1>Esta p&aacute;gina requiere el uso de JavaScript</h1>
    </noscript>

    <?php

        echo "<h1>Ejercicios Básicos Semana 29-04 / 06-05.</h1>";
        
        echo "<p><b>1.Escribe una función recursiva que sume los dígitos de un número.</b></p>";
            echo "<p>Introduzca un número: </p>";
            echo "<form action='index.php' method='post'>";
            echo "<p>Número: <input type='text' name='num'><br></p>";  
            echo $mensaje ."<br/>";
            echo "<input type='submit' name='enviar' value='Enviar'>";
        echo "</form>";


        echo "<p><b>2.Una pila es una estructura de datos a la que se accede siguiendo el siguiente criterio. 
              El primer elemento en entrar es el último elemento en salir. Crea una clase para implementar una pila y haz un script que la utilice.</b></p>";

              echo "<p>Introduzca un valor a la pila: </p>";
              echo "<form action='index.php' method='post'>";
                echo "<p><input type='text' name='elemento'>";
                echo "<input type='submit' name='in' value='Introducir Elemento'>"; 
                echo "<input type='submit' name='out' value='Sacar Elemento'><br></p>";  
              echo "</form>";
              
              echo "Elementos añadidos: <br/>";
              echo $_SESSION["pila"]->imprimirPila();
              echo "<p><a href=\"logout.php\">Cerrar sesión</a></p>";

        echo "<p><b>3.Crea un archivo de texto llamado CARTA y otro con nombres y direcciones llamado LISTA. Escribe un programa para enviar cartas personalizadas a cada una de las personas del archivo LISTA. 
              En el fichero CARTA aparecerá marcado con llaves el texto que debe ser reemplazado. Por ejemplo, Estimado,a {nombre}</b></p>";
         
              crearCarta();

        echo "<br>";
        echo "<br><a href=https://github.com/cralr/DWES/tree/master/Semana29_04-06_05/EjerciciosBasicos><button>Ver Código</button></a>";    


    ?>

</body>
</html>