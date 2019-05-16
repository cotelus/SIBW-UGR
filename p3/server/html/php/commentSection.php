<?php

    require "php/CommentClass.php";

    /* 
        En este archivo, hay que recoger TODOS (por ahora solo recoge uno) los comentarios del evento
        Hay que permitir poder enviar comentarios

            Además:    
                - Botón para moderar el comentario ( con privilegios de usuario )
                - Hay que hacer otra plantilla para los comentarios, para mostrarlos - "singleComent.html"
    */


    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

    /* Hay que hacer la conexión con la base de datos y descargar los comentarios y tal
        */

    // Se conecta con el servidor
    //$conexion = mysql_connect('localhost', 'admin', 'sibw1819');
    // La versión de arriba ( que se propone en el tutorial ) está obsoleta y no funciona
    //$conexion = new mysqli("localhost", "admin", "sibw1819");
    $conexion = mysqli_connect('localhost', 'admin', 'sibw1819', "SIBW_bd");

    // Se abre la base de datos
    //$abreBD = mysqli_select_db('SIBW_bd', $conexion);
    if(!$conexion){
        die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
    }

    if(isset($_GET["eventId"])){
        $eventId=$_GET['eventId'];

        // Esta comprobación, es por si se pasara alguna otra cosa que no fuera un entero para el id del evento
        if( ! is_numeric($eventId) ) {
            $eventId = 1;
        }
    }

    // Se ejecuta una consulta
    // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
    $seleccion = "SELECT * FROM comment WHERE gameEvent = '{$eventId}'";

    //$resultado = mysql_query ($seleccion, $conexion);
    $resultado = mysqli_query($conexion, $seleccion);


    /* Esto estaba preparado para acceder al usuario a través del comentario, asi que lo dejo aqui que me servirá luego 



    // Averiguamos cuantas filas devuelve la consulta
    // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
    $numFilas = mysqli_num_rows ($resultado);


    $fila = mysqli_fetch_array ($resultado, MYSQLI_NUM);
    $usuario = $fila[1];
    $contenido = $fila[3];

    // Se busca en la tabla usuario para coger el nombre del mismo
    $seleccion2 = "SELECT * FROM usuario WHERE id = '{$usuario}'";

    $resultado2 = mysqli_query($conexion, $seleccion2);
    $fila2 = mysqli_fetch_array ($resultado2, MYSQLI_NUM);
    $nombre = $fila2[3];

    // Hace falta una comprobación extra.
    //    - Determinar el número de tuplas devueltas

    // Comprobar que las tuplas devueltas tienen algo que devolver.

    */


    // Averiguamos cuantas filas devuelve la consulta
    // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
    $numFilas = mysqli_num_rows ($resultado);


    $fila = mysqli_fetch_array ($resultado, MYSQLI_NUM);
    $nombre = $fila[2];
    $contenido = $fila[5];

    // Hace falta una comprobación extra.
    //    - Determinar el número de tuplas devueltas

    // Comprobar que las tuplas devueltas tienen algo que devolver.


    echo $twig->render('commentSectionTemplate.html', array(
        'comments' => array( 
            new Comment($nombre, $contenido),
            new Comment('Elca Ballo', 'Increible viaje a la pradera LOL'),
        )));
    

    // Cerramos la conexion con el servidor
    mysqli_close($conexion);
?>