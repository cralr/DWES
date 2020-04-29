<!--  
    Escenario de funcionamiento.

    Crea un sistema que permita generar cuentas de usuario mysql, linux con la información del fichero adjunto.
-->

<?php

    include "funciones/funciones.php";

        if (isset($_POST['enviar'])){
            
            $file = fopen("alumnos.txt","r");
            $contador = 0;
            $contadorUsuariosRepetidos=0;
            $arrayUsuarios = array();
            $ficheroOrigen = fopen($_POST["entrada"],"r");
            do{
                $cadena = normaliza(strtolower(fgets($ficheroOrigen)));
                if($contador > 7){
                    $nombreCompleto = explode(" ", $cadena);
                    $user = substr($nombreCompleto[0],0,2).substr($nombreCompleto[1],0,2).substr($nombreCompleto[2],0,2);
                    do{
                        if (in_array($user,$arrayUsuarios)){
                            $user=$user.$contadorUsuariosRepetidos;
                            $contadorUsuariosRepetidos++;
                        }
                            array_push($arrayUsuarios,$user);
                        
                    }while(!in_array($user,$arrayUsuarios));
                }
                $contador++;
            } while(!feof($ficheroOrigen));
            fclose($ficheroOrigen);

    
            if($_POST["type"] == "mysql"){
                $salida = fopen("salida.txt","w");
                foreach ($arrayUsuarios as $key => $usuarios){
                    $comando1 = "CREATE USER '$usuarios'@'localhost' IDENTIFIED BY '$usuarios' \n";
                    $comando2 = "GRANT ALL PRIVILEGES ON * . * TO '$usuarios'@'localhost' \n";

                    fwrite($salida, $comando1);
                    fwrite($salida, $comando2);
                }   
                fclose($salida);
            }

            if ($_POST["type"] == "linux"){
                $salida = fopen("salida.txt","w");
                foreach ($arrayUsuarios as $key => $usuarios){
                    $comando1 = "sudo useradd $usuarios \n";
                    $comando2 = "sudo passwd $usuarios \n";

                    fwrite($salida, $comando1);
                    fwrite($salida, $comando2);
                }   
                fclose($salida);
            }
        }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Ficheros</title>
</head>
<body>
    <h1>Generación de Usuarios Linux o Mysql</h1>

    
    <?php

        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<p><b>Elige el fichero</b></p>";
        echo "<input type='file' name='entrada'>";
        echo "<br/><br/>";
        echo "<p>Elige el tipo de comando:</p>";
        echo "<select name='type'>";
            echo "<option></option>";
            echo "<option value='mysql'>MySql</option>";
            echo "<option value='linux'>Linux</option>";
        echo "</select>";
        echo "<br/><br>";
        echo "<input type='submit' name='enviar' value='Enviar'>";
        echo "</form>";

        echo "<br>";
        echo "<br><a href=https://github.com/cralr/DWES/tree/master/Semana22_04-29_04/GeneracionUsuarios><button>Ver Código</button></a>"; 
        
    ?>
</body>
</html>