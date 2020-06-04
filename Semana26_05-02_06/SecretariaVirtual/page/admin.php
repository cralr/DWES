<!--
    Página admin del ejercicio Secretaria
-->

<?php

    if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !=="admin")){
        header("Location: index.php?page=index");
    }

        echo "<div class='mostrarInfo'>";     
            echo "<form action='index.php?page=admin' method=\"post\">";
                echo "<br/><br/>";
                echo "Buscar: <input type='text' name='busqueda'>";
                echo "<input type='submit' value='Buscar' name='buscar'>";
        echo "</form>";

        //Mostrar Usuarios

        if (isset($_POST["buscar"])){
            $mostrarLista = $_SESSION["user"]->buscarUsuario($_POST["busqueda"]);
            echo "<br/><br/>Lista de Usuarios";
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Email</th><th>Usuario</th><th>Perfil</th><th>Estado</th><th>Validar</th><th>Bloquear</th></tr>";
            foreach ($mostrarLista as $value){
                echo "<tr>";
                    echo "<td>"; 
                        echo $value['nombre'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['email'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['usuario'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['perfil'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['estado'];
                    echo "</td>";
                    echo ( $value['perfil'] == "admin" ? "<td>---</td>" : 
                    "<td><a href='"."index.php?page=admin&validar=".$value["id"]."'><button>Validar</button></a></td>");
                    echo ( $value['perfil'] == "admin" ? "<td>---</td>" : 
                    "<td><a href='"."index.php?page=admin&bloquear=".$value["id"]."'><button>Bloquear</button></a></td>"); 
                echo "</tr>";
            }    
            echo "</table>";
            echo "</table>";
        }else{
            echo "<br/><br/>Lista de Usuarios<br/>";
            $mostrarLista = $_SESSION["user"]->getUsuario();
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Email</th><th>Usuario</th><th>Perfil</th><th>Estado</th><th>Validar</th><th>Bloquear</th></tr>";
            foreach ($mostrarLista as $value){
                echo "<tr>";
                    echo "<td>"; 
                        echo $value['nombre'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['email'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['usuario'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['perfil'];
                    echo "</td>";
                    echo "<td>"; 
                        echo $value['estado'];
                    echo "</td>";
                    echo ( $value['perfil'] == "admin" ? "<td>---</td>" : 
                    "<td><a href='"."index.php?page=admin&validar=".$value["id"]."'><button>Validar</button></a></td>");
                    echo ( $value['perfil'] == "admin" ? "<td>---</td>" : 
                    "<td><a href='"."index.php?page=admin&bloquear=".$value["id"]."'><button>Bloquear</button></a></td>");                    
                echo "</tr>";
            }    
            echo "</table>";
        }

        //Validar

        if(isset($_GET["validar"])){
            if($_SESSION["user"]->getUsuarioById($_GET['validar'])[0]['estado']=='pendiente'){
                $_SESSION["user"]->activarUsuario($_GET['validar']);
                $directorio = $_SESSION["user"]->getDirectorio($_GET['validar'])[0]['directorio'];
                
                $clave = array();
                $letras = array("a","b","c","d","e","f","g","h");

                $salida = fopen("./usuario/".$directorio."/claves.txt","w");
                fwrite($salida, " ");

                for ($cabecera = 1; $cabecera < 9; $cabecera++){
                    $linea = "   ".$cabecera;
                    fwrite($salida,$linea);
                }

                for($i=0;$i<8;$i++){
                    array_push($clave,array());
                    $lineaLetras = "\n".$letras[$i];
                    fwrite($salida, $lineaLetras);
                    for($j=0;$j<8;$j++){
                        array_push($clave[$i],rand(0,999));
                        $lineaValores = " ".$clave[$i][$j];
                        fwrite($salida, $lineaValores);  
                    }
                }

                for($i=0;$i<8;$i++){
                    for($j=0;$j<8;$j++){
                        $_SESSION["clave"]->set($_GET['validar'],$i+1,$j+1,$clave[$i][$j]);
                    }
                }

                fclose($salida);
                
                header("Location: index.php?page=admin");
            }elseif($_SESSION["user"]->getUsuarioById($_GET['validar'])[0]['estado']=='bloqueado'){
                $_SESSION["user"]->activarEstadoBloqueado($_GET['validar']);
                header("Location: index.php?page=admin");
            }
            
        }

        //Bloquear

        if(isset($_GET["bloquear"])){
            $_SESSION["user"]->bloquearUsuario($_GET['bloquear']);
            header("Location: index.php?page=admin");
        }

    echo "</div>";
?>     