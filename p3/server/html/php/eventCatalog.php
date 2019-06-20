<?php
    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

   /* Aquí se hacen las tareas del modelo. Se va a consultar a la base de datos para obtener una serie de eventos (ahora mismo todos, pero se pueden poner limites y paginación)
        - Se abre la conexión con la BBDD
        - Se obtiene una cantidad de eventos X
        - Se rellena la plantilla "singleEventTemplate.html" con cada uno de los eventos
        - Se cierra la conexión
    */
    

    // Se conecta con el servidor
    //$conexion = mysql_connect('localhost', 'admin', 'sibw1819');
    // La versión de arriba ( que se propone en el tutorial ) está obsoleta y no funciona
    //$conexion = new mysqli("localhost", "admin", "sibw1819");
    $conexion = mysqli_connect('localhost', 'administrador', 'admin123', "sibw");

    // Se abre la base de datos
    //$abreBD = mysqli_select_db('SIBW_bd', $conexion);
    if(!$conexion){
        die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
    }

    // Se ejecuta una consulta
    // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
    $seleccion = 'SELECT * FROM evento WHERE idEvento = 2';

    //$resultado = mysql_query ($seleccion, $conexion);
    $resultado = mysqli_query($conexion, $seleccion);


    // Averiguamos cuantas filas devuelve la consulta
    // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
    $numFilas = mysqli_num_rows ($resultado);


    $fila = mysqli_fetch_array ($resultado, MYSQLI_NUM);
    $nombre = $fila[0];
    $imagenPortada = $fila[1];
    // Hace falta una comprobación extra.
    //    - Determinar el número de tuplas devueltas

    // Comprobar que las tuplas devueltas tienen algo que devolver.


    echo $twig->render('singleEventTemplate.html',
        ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

    echo $twig->render('singleEventTemplate.html',
        ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

    echo $twig->render('singleEventTemplate.html',
        ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

    echo $twig->render('singleEventTemplate.html',
        ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

    echo $twig->render('singleEventTemplate.html',
        ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

    // Cerramos la conexion con el servidor
    mysqli_close($conexion);

?>