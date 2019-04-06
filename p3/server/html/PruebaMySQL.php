<!-- En este ejemplo hay varias funciones de php y mysql comentadas 
    debido a que están obsoletas y hacen que el código no funcione.
    No obstante, las dejo como comentarios para ilustrarlo bien. -->
<!DOCTYPE html>
<html lang="es">
<head>
<title> EJEMPLO DE ACCESO MYSQL PHP</title>
</head>

<body>
    <?php
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

        // Se ejecuta una consulta
        $seleccion = 'SELECT * FROM usuario';
        //$resultado = mysql_query ($seleccion, $conexion);
        $resultado = mysqli_query($conexion, $seleccion);


        // Averiguamos cuantas filas devuelve la consulta
        $numFilas = mysqli_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos
        if($numFilas> 0){
            // Retornamos el número total de filas devueltas
            echo "Total de filas: " . $numFilas;

            // Creamos una tabla donde se pone una fila con los nombres de los campos
            echo '<center>';            // Se centra la tabla
            echo '<table border=1>';
            echo '<tr><th>USUARIO</th><th>ID</th><th>password</th><th>nombre</th></tr>';

            // Añadimos a la tabla las filas de datos que haya devuelto la consulta
            while($fila = mysqli_fetch_array ($resultado, MYSQLI_NUM)){
                echo "<tr><td>$fila[0]</td><td>$fila[1]</td><td>$fila[2]</td><td>$fila[3]</td></tr>";
            }

            // Cerramos la tabla y quitamos el centrado de la misma
            echo '</table>';
            echo '<center>';            
        }

        // Cerramos la conexion con el servidor
        mysql_close($conexion);

        echo "hola again";
    ?>

</body>
</html>