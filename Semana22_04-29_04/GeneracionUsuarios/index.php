fichero: ------?(Elegir fichero)
Salida: select ( linux, mysql)

    enviar

if isset(enviar)

    subirFichero:alumnos2daw.txt

    moveTo: origen.txt
    formatoSalida<- mysql

    open(origen.txt,r)
    open(origen.txt,w)
    while !feof(origen){
        cadena<-fgets(origen)
        usuario = convertirCadenaAUsuario(cadena)
        if salida = mysql
            comando1 = "create user $usuario identify by " ;
            comando2 = "grant privileges on *";
            fputs(salida.txt, comando1)
            fputs(salida,comando2)
    }

    location 
    header() // descarga del fichero
    