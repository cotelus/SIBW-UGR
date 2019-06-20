<?php
    /* Aquí se hacen las tareas del modelo. Se va a consultar a la base de datos para obtener una serie de eventos (ahora mismo todos, pero se pueden poner limites y paginación)
        - Se abre la conexión con la BBDD
        - Se obtiene una cantidad de eventos X
        - Se pasan esos eventos por GET
        - Se cierra la conexión
    */
    
    class ConectarABaseDatos{

        static function getAllEvents(){
            // Se conecta con el servidor, con un usuario administrador
            $conexion = mysqli_connect('localhost', 'administrador', 'admin123', "sibw");

            if(!$conexion){
                die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
            }


            // Se ejecuta una consulta
            // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
            $seleccion = 'SELECT idEvento, nombreMiniatura, fotoMiniatura FROM evento WHERE idEvento = 1';

            //$resultado = mysql_query ($seleccion, $conexion);
            $resultado = mysqli_query($conexion, $seleccion);


            // Averiguamos cuantas filas devuelve la consulta
            // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
            $numFilas = mysqli_num_rows ($resultado);

            $fila = mysqli_fetch_array ($resultado, MYSQLI_NUM);

            $eventos = $fila;

            $nombre = $fila[0];
            $imagenPortada = $fila[1];
            // Hace falta una comprobación extra.
            //    - Determinar el número de tuplas devueltas

            // Comprobar que las tuplas devueltas tienen algo que devolver.

            mysqli_close($conexion);

            return $eventos;
        }

        static function getEvent($idEvento){
            // Se conecta con el servidor, con un usuario administrador
            $conexion = mysqli_connect('localhost', 'administrador', 'admin123', "sibw");

            if(!$conexion){
                die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
            }


            // Se ejecuta una consulta
            // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
            $seleccion = "SELECT * FROM evento WHERE idEvento = '{$idEvento}'";

            //$resultado = mysql_query ($seleccion, $conexion);
            $resultado = mysqli_query($conexion, $seleccion);


            // Averiguamos cuantas filas devuelve la consulta
            // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
            $numFilas = mysqli_num_rows ($resultado);

            $fila = mysqli_fetch_array ($resultado, MYSQLI_NUM);

            $eventos = $fila;
            // Hace falta una comprobación extra.
            //    - Determinar el número de tuplas devueltas

            // Comprobar que las tuplas devueltas tienen algo que devolver.

            mysqli_close($conexion);

            return $eventos;
        }

    }

?>