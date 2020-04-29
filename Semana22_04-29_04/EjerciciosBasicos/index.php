<!--

1. Crea una función para pasar un número en notación romana a notación arábiga. Prueba la función con los siguientes valores:

LXXXVI (86), CCCXIX (319), MCCLIV (1254)

M:1000, D:500, C:100, L:50, X:10, V:5, I:1

2. Un número perfecto es un entero positivo, que es igual a la suma de todos los enteros positivos que son divisores del número. El primer número perfecto es 6, ya que los divisores de 6 son 1, 2 y 3. Escribe un script que muestre los tres primeros números perfectos y su suma.

3. Una matriz cuadrada A se dice que es simétrica si A(i,j) = A(j,i) para todo i,j dentro de los límites de la matriz. Escribe una función que determine si una matriz es cuadrada y un programa que permita introducir el tamaño de la matriz y sus elementos en un formulario.

-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Rafael Miguel Cruz Álvarez">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicios Básicos Semana 2</title>
</head>
<body>
    <noscript>
        <h1>Esta p&aacute;gina requiere el uso de JavaScript</h1>
    </noscript>

    <?php

        echo "<h1>Ejercicios Básicos Semana 22-04 / 29-04.</h1>";
        

        include "funciones/funciones.php";

        echo "<p><b>1.Crea una función para pasar un número en notación romana a notación arábiga.</b></p>";
        echo "<p>Introduzca un número: </p>";
        echo "<form action='index.php' method='post'>";
        echo "<p>Número: <input type='text' name='num'><br></p>";  

         if (isset($_POST["enviar"])){
            if (isset($_POST["num"]) && ($_POST['num'] != "")){
                echo "El número ". $_POST["num"] . " en arábigo es: ".numRomanoToArabigo($_POST["num"]);
                echo "<br/>";
            }
        }
        echo "<input type='submit' name='enviar' value='Enviar'>";
        echo "</form>";


        echo "<p><b>2.Un número perfecto es un entero positivo, que es igual a la suma de todos los enteros positivos que son divisores del número. El primer número perfecto es 6, ya que los divisores de 6 son 1, 2 y 3. Escribe un script que muestre los tres primeros números perfectos y su suma.</b></p>";
        echo listadoNumerosPerfectos();

        echo "<p><b>3.Una matriz cuadrada A se dice que es simétrica si A(i,j) = A(j,i) para todo i,j dentro de los límites de la matriz. Escribe una función que determine si una matriz es cuadrada y un programa que permita introducir el tamaño de la matriz y sus elementos en un formulario.</b></p>";
        echo "<form action='index.php' method='post'>";
        echo "<p>Introduzca el tamaño de la matriz: </p>";
        echo "<p>Tamaño: <input type='text' name='tamanyo'><br></p>"; 
        echo "<p><input type='submit' name='enviar' value='Enviar' ></p>
        </form>";
        
        if (isset($_POST["tamanyo"])){
           echo "<form action='index.php' method='post'>";
           echo "<p>Introduzca los valores de la matriz";
           for ($i=0; $i < $_POST["tamanyo"]; $i++) { 
            echo "<br>";
                for ($j=0; $j < $_POST["tamanyo"]; $j++) { 
                echo "<input type='number' name='valores[$i][$j]' >";
                }
            }

            echo "<p><input type='submit' name='enviar' value='Enviar' ></p>
            </form>";

        }

        if (isset($_POST["valores"])) {
           echo comprobarMatriz();
        }
         

        echo "<br>";
        echo "<br><a href=https://github.com/cralr/DWES/tree/master/Semana22_04-29_04/EjerciciosBasicos><button>Ver Código</button></a>";    


    ?>

</body>
</html>



