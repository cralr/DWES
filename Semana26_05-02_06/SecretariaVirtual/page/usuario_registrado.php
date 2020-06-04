<!--
    Página usuario del ejercicio Secretaria
-->

<?php

    if(!isset($_SESSION["perfil"] ) || ($_SESSION["perfil"] !=="registrado")){
        header("Location: ../index.php");
    }

    echo "<div class='mostrarInfo'>";

        if($_SESSION['estado']=="pendiente"){
            echo "<p>Su cuenta aún no ha sido activada por un administrador.</p>";
            echo "<p>Perdone las molestias.</p>";
        }else{
            echo "<form action='index.php?page=registrado' method=\"post\">";
                echo "<br/><br/>";
                echo "Buscar Documento: <input type='text' name='busqueda'>";
                echo "<input type='submit' value='Buscar' name='buscar'></a></button>";
                echo "<input type='submit' value='Nuevo Documento' name='nuevoDocumento'></a></button>";
            echo "</form>";
            //Realizar Busqueda o Mostrar lista completa

            if (isset($_POST["buscar"])){
                $mostrarLista = $_SESSION["documento"]->buscarDocumento($_POST["busqueda"],$_SESSION['id_usuario']);
                echo "<br/><br/>Lista de Documentos";
                echo "<table>";
                echo "<tr><th>Descripción</th><th>Fichero</th><th>Estado</th><th>Firmar</th><th>Fecha Firma</th></tr>";
                foreach ($mostrarLista as $value){
                    echo "<tr>";
                        echo "<td>"; 
                            echo $value['descripcion'];
                        echo "</td>";
                        echo "<td>"; 
                            echo $value['fichero'];
                        echo "</td>";
                        echo "<td>"; 
                            echo $value['estado'];
                        echo "</td>";
                        echo "<td>"; 
                            echo "<a href='"."index.php?page=registrado&firmar=".$value["id"]."'><button>Firmar</button></a>";
                        echo "</td>";
                        echo "<td>"; 
                            echo $value['fechaFirma'];
                        echo "</td>";
                    echo "</tr>";
                }    
                echo "</table>";
            }else if (isset($_POST["nuevoDocumento"])){
                echo "<b>Nuevo Documento</b><br/>";
            
                echo "<form enctype='multipart/form-data' action=".$_SERVER["PHP_SELF"]."?page=registrado"." method='post'><br/>";
                    echo "Descripción <input type='text' name='descripcion'><br/>";
                    echo "<input type='hidden' name='MAX_FILE_SIZE' value='800000'>";
                    echo "Fichero <input type='file' name='fichero'><br/>";
                    echo "<input type='submit' name='subida' value='Subir Fichero'>";
                    echo "<br/>";
                echo "</form>";

                

            }
            else{
                $mostrarLista = $_SESSION["documento"]->getDocumentosByUser($_SESSION['id_usuario']);
                echo "<br/><br/>Lista de Documentos";
                echo "<table>";
                echo "<tr><th>Fichero</th><th>Descripción</th><th>Estado</th><th>Firmar</th><th>Fecha Firma</th></tr>";
                foreach ($mostrarLista as $value){
                    echo "<tr>";
                        echo "<td>"; 
                            echo $value['fichero'];
                        echo "</td>";
                        echo "<td>"; 
                            echo $value['descripcion'];
                        echo "</td>";
                        echo "<td>"; 
                            echo $value['estado'];
                        echo "</td>";
                        echo "<td>"; 
                            echo "<a href='"."index.php?page=registrado&firmar=".$value["id"]."'><button>Firmar</button></a>";
                        echo "</td>";
                        echo "<td>"; 
                            echo $value['fechaFirma'];
                        echo "</td>";
                    echo "</tr>";
                }    
                echo "</table>";
            }
    
            if(isset($_POST["subida"])){
                $documento = "file".date("HmsdmY").".txt";
                $directorio=$_SESSION["directorio"];

                move_uploaded_file($_FILES['fichero']['tmp_name'],"./usuario/".$directorio."/".$documento);

                $array_datos = array(
                    'idUsuario'=> $_SESSION["id_usuario"],
                    'descripcion'=>$_POST["descripcion"],
                    'fichero'=>$documento,
                    'estado'=>"pendiente"
                );

                $_SESSION["documento"]->set($array_datos);
                header("Location: index.php?page=registrado");
            }

            if(isset($_GET['firmar'])){
                $firmaDocumento = $_SESSION["documento"]->getDocumentoById($_GET['firmar'],$_SESSION['id_usuario']);
                if($firmaDocumento){
                    $fila = getLetra(rand(0,7));
                    $columna = rand(1,8);
                    echo "<form action=".$_SERVER["PHP_SELF"]."?page=registrado"." method='post'><br/>";
                        echo "Código ".$fila.$columna."<input type='text' name='codigo' value=''><br/>";
                        echo "<input type='hidden' name='fila' value=".$fila.">";
                        echo "<input type='hidden' name='columna' value=".$columna.">";
                        echo "<input type='hidden' name='id' value=".$_GET['firmar'].">";
                        echo "<input type='submit' name='firma' value='Firmar'>";
                        echo "<br/>";
                    echo "</form>";
                }
            }

            if(isset($_POST['firma'])){
                if($_POST['codigo'] == $_SESSION['clave']->getValor($_SESSION['id_usuario'],$_POST['fila'],$_POST['columna'])){
                    $_SESSION["documento"]->firmarDocumento($_POST["id"],$_SESSION['id_usuario']);
                    header("Location: index.php?page=registrado");
                }else{
                    echo "Clave inválida.";
                }
            }

        }

    echo "</div>";
 
?>