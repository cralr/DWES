<?php
        include ("config/constantes.php");
        include("class/Libro.php");
	
        $datos = array ('id'=> 1,
                'titulo'=>'El quijote',
                'autor'=>'Cervantes');
        
        echo "añadiendo"; 	
        $libro = new Libro();
        $libro->set($datos);
?>