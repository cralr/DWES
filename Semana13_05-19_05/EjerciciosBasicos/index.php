<!--

1.Imprime la suma de elementos de un vector A de subíndices 1..n con una función recursiva.
2.Crear una clase que implemente la estructura de datos cola.
3.Utilizando las estructuras creadas, crea un programa que determine si una expresión con paréntesis está equilibrada.
-->


<?php

include "class/Cola.php";
include "funciones/funciones.php";

session_start();

    //Ejercicio 1

    
    if (!isset($_SESSION["vector"])) {
        $_SESSION["vector"] = array();
    }

    //Ejercicio 2

    if(!isset($_SESSION["cola"])){
        $_SESSION["cola"] = new Cola();
    }


    if(isset($_POST['in'])){
        if (isset($_POST["elemento"]) && ($_POST['elemento'] != "")){
           $_SESSION["cola"]->introducirElemento($_POST['elemento']);  
        }
    }
    
    if(isset($_POST['out'])){
        $_SESSION["cola"]->sacarElemento();  
    } 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Rafael Miguel Cruz Álvarez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicios Básicos Semana 4</title>
</head>
<body>
    <noscript>
        <h1>Esta p&aacute;gina requiere el uso de JavaScript</h1>
    </noscript>

    <?php

        echo "<h1>Ejercicios Básicos Semana 13-05 / 19-05.</h1>";
        
        echo "<p><b>1.Imprime la suma de elementos de un vector A de subíndices 1..n con una función recursiva.</b></p>";
        echo "<p>Introduzca un valor para el vector: </p>";
        echo "<form action='index.php' method='post'>";
        echo "<p>Valor: <input type='text' name='num'><br></p>";  
            if(isset($_POST['annadir'])){
                array_push($_SESSION['vector'],$_POST['num']);
            }

            if(isset($_SESSION['vector'])){
                echo "Vector: ";
                foreach ($_SESSION['vector'] as $key => $value) {
                    echo $value." ";
                }
            }

            if (isset($_POST['suma'])){
                echo "<p>La suma de los elementos del vector es " .sumaElementosVector($_SESSION["vector"])."</p>";
            }
        echo "<br/>";
        echo "<input type='submit' name='annadir' value='Añadir Elemento'>";
        echo "<input type='submit' name='suma' value='Sumar Elementos'>";
        echo "</form>";
        echo "<p><a href=\"logout.php\">Cerrar sesión</a></p>";


        echo "<p><b>2.Crear una clase que implemente la estructura de datos cola.</b></p>";
        echo "<p>Introduzca un valor a la cola: </p>";
        echo "<form action='index.php' method='post'>";
          echo "<p><input type='text' name='elemento'>";
          echo "<input type='submit' name='in' value='Introducir Elemento'>"; 
          echo "<input type='submit' name='out' value='Sacar Elemento'><br></p>";  
        echo "</form>";
        
        echo "Elementos añadidos: <br/>";
        echo $_SESSION["cola"]->imprimirCola();
        echo "<p><a href=\"logout.php\">Cerrar sesión</a></p>";

        echo "<p><b>3.Utilizando las estructuras creadas, crea un programa que determine si una expresión con paréntesis está equilibrada.</b></p>";
        echo "<form action='index.php' method='post'>";



        echo "<p><input type='submit' name='enviar' value='Enviar' ></p>
        </form>";
    

    


         

        echo "<br>";
        echo "<br><a href=https://github.com/cralr/DWES/tree/master/Semana22_04-29_04/EjerciciosBasicos><button>Ver Código</button></a>";    


    ?>

</body>
</html>



