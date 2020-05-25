<?php

    function limpiarDatos($limpiar){
        $error = trim($limpiar);
        $error = stripslashes($limpiar);
        $error =  htmlspecialchars($limpiar);
        return $error;
    }

    function cerrarSesion(){
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
    }

    function imprimeLibroLector($resultados){
        echo "<table>";
            echo "<tr><th>Título</th><th>Autor</th><th>Editorial</th></tr>";
                foreach ($resultados as $libro) {
                    echo "<tr>";
                        echo "<td>".$libro['titulo']."</td>";
                        echo "<td>".$libro['autor']."</td>"; 
                        echo "<td>".$libro['editorial']."</td>"; 
                    echo "</tr>";
                }
        echo "</table>";
    }

?>