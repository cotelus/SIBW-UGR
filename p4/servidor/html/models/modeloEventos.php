<?php

    /*  Esta clase modelo va a ser la encargada de hacer las conexiones a la Base de Datos de todo lo relacionado con los eventos 
    */

    include ("/models/conectarBaseDatos.php");
    // En primer lugar, realizamos la conexión
    $conexion = ConectarABaseDatos.makeConectionTypeAdmin();

    $seleccion = "SELECT * FROM gameEvent WHERE idEvento = 1";

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


    echo $twig->render('eventFullTemplate.html',
        ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

    // Cerramos la conexion con el servidor
    mysqli_close($conexion);


?>