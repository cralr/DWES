<?php

    include ("../config/parameters.php");
    include ("../config/config_dev.php");
    include ("../funciones/funciones.php");
    include ("../class/Usuario.php");

    session_start();

    if(!isset($_SESSION["user"])){
        $_SESSION["user"] = Usuario::getInstancia();
        $_SESSION["mensaje"] = "";
    }
?>


<!DOCTYPE html>
	<head>
		<title><?php echo $TITULO ?></title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../css/normalize.css">
    	<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<header>
            <?php include "../include/cabecera.php"; ?>
		</header>

        <div class="contenedor">
            <main>
            <?php
                if (isset($_POST['registrar'])) {

                    $user_data = array('usuario'=>limpiarDatos($_POST['usuario']),
                                        'pass'=>limpiarDatos($_POST['pass']),
                                        'nombre'=>limpiarDatos($_POST['nombre']),
                                        'apellidos'=>limpiarDatos($_POST['apellidos']),
                                        'email'=>limpiarDatos($_POST['email']),
                                        'estado'=>"pendiente",
                                        'perfil'=>'registrado'
                     );
            
                    if (sizeof($_SESSION["user"]->usuarioExistente($user_data["usuario"])) == 1 ){
                        header('Location:registro.php');
                        
                    }
                    else{
                        $_SESSION["user"]->set($user_data);
                        header('Location:../index.php'); 
                    }
                    
                }
            
                echo "<b>Formulario de Registro</b><br/>";
            
                echo "<form action='registro.php' method='post'><br/>";
                    echo "Usuario <input type='text' name='usuario'><br/>";
                    echo "Contraseña <input type='password' name='pass'><br/>";
                    echo "Nombre <input type='text' name='nombre'><br/>";
                    echo "Apellidos <input type='text' name='apellidos'><br/>";
                    echo "Email <input type='text' name='email'><br/>";
                    echo "<input type='submit' name='registrar' value='Registrar'>";
                    echo "<br/>";
                echo "</form>";
            ?>    
            </main>
        </div>
		<footer>
            <?php include "../include/footer.php";?>
		</footer>
</html>