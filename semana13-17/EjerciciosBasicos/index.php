<!-- 
    1.Crear una clase dni. Utiliza un método para su correcta validación.
    2.Escribe una función que determine si un número es primo.
    3.Utilizando la funcion anterior crea un array que almacene los primeros 5 números primos.
-->
<?php

    echo "<h1>Ejercicios Básicos.</h1>";
    

    include "class/dni.php";
    include "cincoPrimos.php";

    echo "<p><b>1.Crear una clase dni. Utiliza un método para su correcta validación.</b></p>";
    $dni= new Dni("45944018T");
    echo $dni->getMensaje();

    echo "<p><b>2.Escribe una función que determine si un número es primo.</b></p>";
    echo "<p>Introduzca un número: </p>";
    echo "<form action='index.php' method='post'>";
    echo "<p>Número: <input type='text' name='num'><br></p>";  

    if (isset($_POST["enviar"])){
        if (isset($_POST["num"])){
            if (esPrimo($_POST["num"])) {
                echo "<p>El número " .$_POST["num"]." es primo.</p>";
            }else{
                echo "<p>El número ".$_POST["num"]." no es primo.</p>";
            }
        }
    }

    echo "<input type='submit' name='enviar' value='Enviar'>";
    echo "</form>";

    echo "<p><b>3.Utilizando la funcion anterior crea un array que almacene los primeros 5 números primos.</b></p>";

    cincoPrimosIniciales();


    echo "<br>";
    echo "<br><a href='../verCodigo.php?src=".__FILE__."'><button>Ver Código</button></a>";    

?>