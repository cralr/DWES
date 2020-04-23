<!--

1. Crea una función para pasar un número en notación romana a notación arábiga. Prueba la función con los siguientes valores:

LXXXVI (86), CCCXIX (319), MCCLIV (1254)

M:1000, D:500, C:100, L:50, X:10, V:5, I:1

2. Un número perfecto es un entero positivo, que es igual a la suma de todos los enteros positivos que son divisores del número. El primer número perfecto es 6, ya que los divisores de 6 son 1, 2 y 3. Escribe un script que muestre los tres primeros números perfectos y su suma.

3. Una matriz cuadrada A se dice que es simétrica si A(i,j) = A(j,i) para todo i,j dentro de los límites de la matriz. Escribe una función que determine si una matriz es cuadrada y un programa que permita introducir el tamaño de la matriz y sus elementos en un formulario.

-->



<?php

    echo "<h1>Ejercicios Básicos Semana 22-04 / 29-04.</h1>";
    

    include "funciones/funciones.php";

    echo "<p><b>1.Crea una función para pasar un número en notación romana a notación arábiga.</b></p>";
    echo "<p>Introduzca un número: </p>";
    echo "<form action='index.php' method='post'>";
    echo "<p>Número: <input type='text' name='num'><br></p>";  

    if (isset($_POST["enviar"])){
        if (isset($_POST["num"])){
            
        }
    }

    echo "<input type='submit' name='enviar' value='Enviar'>";
    echo "</form>";


    echo "<p><b>2.Un número perfecto es un entero positivo, que es igual a la suma de todos los enteros positivos que son divisores del número. El primer número perfecto es 6, ya que los divisores de 6 son 1, 2 y 3. Escribe un script que muestre los tres primeros números perfectos y su suma.</b></p>";
    echo listadoNumerosPerfectos();

    echo "<p><b>3.Una matriz cuadrada A se dice que es simétrica si A(i,j) = A(j,i) para todo i,j dentro de los límites de la matriz. Escribe una función que determine si una matriz es cuadrada y un programa que permita introducir el tamaño de la matriz y sus elementos en un formulario.</b></p>";
    echo "<form action='index.php' method='post'>";
    echo "<p>Introduzca una fila: </p>";
    echo "<p>Fila: <input type='text' name='fila'><br></p>"; 
    echo "<p>Introduzca una columna: </p>";
    echo "<p>Columna: <input type='text' name='columna'><br></p>"; 

    if (isset($_POST["enviar3"])){
        if (isset($_POST["fila"]) && isset($_POST['columna'])){
            
        }
    }

    echo "<input type='submit' name='enviar3' value='Enviar'>";
    echo "</form>";



    echo "<br>";
    echo "<br><a href=https://github.com/cralr/DWES/tree/master/Semana22_04-29_04/EjerciciosBasicos><button>Ver Código</button></a>";    


?>


