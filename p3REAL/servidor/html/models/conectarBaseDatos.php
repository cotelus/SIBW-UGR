<?php
    /* Aquí se hacen las tareas del modelo. Se va a consultar a la base de datos para obtener una serie de eventos (ahora mismo todos, pero se pueden poner limites y paginación)
        - Se abre la conexión con la BBDD
        - Se obtiene una cantidad de eventos X
        - Se pasan esos eventos por GET
        - Se cierra la conexión
    */
    require("class/comentario.php");
    
    class ConectarABaseDatos{

        // Esta función crea una conexión en calidad de usuario administrador de la BD
        static function makeConnectionAdmin(){
            // Se conecta con el servidor, con un usuario administrador
            $conexion = mysqli_connect('localhost', 'administrador', 'admin123', "sibw");
            mysqli_query("SET NAMES 'utf8'");

            if(!$conexion){
                die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
            }

            return $conexion;
        }

        // Esta función cierra cualquier conexión que se le pase
        static function closeConnection($conexion){
            mysqli_close($conexion);
        }

        // Esta función recoge TODOS los eventos (idEvento, nombreMiniatura e imagenMiniatura de cada evento)
        static function getAllEvents(){

            $conexion = ConectarABaseDatos::makeConnectionAdmin();

            // Se ejecuta una consulta
            // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
            $seleccion = 'SELECT idEvento, nombreMiniatura, fotoMiniatura FROM evento';

            //$resultado = mysql_query ($seleccion, $conexion);
            $resultado = mysqli_query($conexion, $seleccion);


            // Averiguamos cuantas filas devuelve la consulta
            // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
            $numFilas = mysqli_num_rows ($resultado);

            $eventos = array ($numFilas);

            while ($fila = $resultado->fetch_assoc()) {

                array_push($eventos,$fila['idEvento'], $fila['nombreMiniatura'], $fila['fotoMiniatura']);
            }

            // Hace falta una comprobación extra.
            //    - Determinar el número de tuplas devueltas

            // Comprobar que las tuplas devueltas tienen algo que devolver.

            ConectarABaseDatos::closeConnection($conexion);

            return $eventos;
        }

        static function getEvent($idEvento){
            $conexion = ConectarABaseDatos::makeConnectionAdmin();

            // Se ejecuta una consulta
            // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
            $seleccion = "SELECT * FROM evento WHERE idEvento = '{$idEvento}'";

            //$resultado = mysql_query ($seleccion, $conexion);
            $resultado = mysqli_query($conexion, $seleccion);


            // Averiguamos cuantas filas devuelve la consulta
            // Coger tambien cuantos eventos finales han sido devueltos, es decir, el numero de tuplas
            $numFilas = mysqli_num_rows ($resultado);

            $evento = mysqli_fetch_array ($resultado, MYSQLI_NUM);
            // Hace falta una comprobación extra.
            //    - Determinar el número de tuplas devueltas

            // Comprobar que las tuplas devueltas tienen algo que devolver.

            //mysqli_close($conexion);
            ConectarABaseDatos::closeConnection($conexion);

            return $evento;
        }

        static function getComments($idEvento){
            // Se establece la conexion
            $conexion = ConectarABaseDatos::makeConnectionAdmin();

            // Se ejecuta una consulta
            // Aquí se debe coger todos los eventos, o una cuña de 10 al menos
            $seleccion = "SELECT * FROM comentario WHERE evento = '{$idEvento}'";

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

            // Array para los comentarios
            $comentarios = array();

            while($fila = mysqli_fetch_array($resultado)){
                $ip = utf8_encode($fila[1]);
                $username = utf8_encode($fila[2]);
                $email = utf8_encode($fila[3]);
                $date = utf8_encode($fila[4]);
                $time = utf8_encode($fila[5]);
                $text = utf8_encode($fila[6]);
                $comentario = new Comentario($ip, $username, $email, $date, $time, $text);
                //array_push ($comentarios, $comentario);
                $comentarios[] = $comentario;

            }

            ConectarABaseDatos::closeConnection($conexion);

            // Antes de devolver nada, ya que vamos a usar la lista de palabras prohibidas al cargar el comentario, cargamos las palabras prohibidas
            //getForbiddenWords();

            ConectarABaseDatos::getForbiddenWords();
            //getForbiddenWords();

            return $comentarios;
        }

        static function getForbiddenWords(){
            $conexion = ConectarABaseDatos::makeConnectionAdmin();
    
            /* 
                Una vez cargados los comentarios de la página de la BBDD, se descarga la lista de palabras prohibidas y se guarda en un array
            */
            $palabras = "SELECT * FROM palabrasProhibidas";
    
            $resultadoPalabras = mysqli_query($conexion, $palabras);
    
            $forbiddenWords = array();
    
            while($fila = mysqli_fetch_array($resultadoPalabras)){
                $palabra = utf8_encode($fila[0]); 
                array_push ($forbiddenWords, $palabra);
            }
    
            // Cerramos la conexion con el servidor
            ConectarABaseDatos::closeConnection($conexion);
    
            // Se pasa a js el array de palabras prohibidas
            echo '<script type="text/javascript">var forbiddenWords =';
            echo json_encode($forbiddenWords); 
            echo '</script>';
        }

        static function getAllTags(){
            $conexion = ConectarABaseDatos::makeConnectionAdmin();
            /* 
                Una vez cargados los comentarios de la página de la BBDD, se descarga la lista de palabras prohibidas y se guarda en un array
            */
            $nombres = "SELECT * FROM etiqueta";
    
            $resultadoNombres = mysqli_query($conexion, $nombres);
    
            $etiquetas = array();
    
            while($fila = mysqli_fetch_array($resultadoNombres)){
                $nombre = utf8_encode($fila[0]); 
                array_push ($etiquetas, $nombre);
            }
    
            // Cerramos la conexion con el servidor
            ConectarABaseDatos::closeConnection($conexion);

            return $etiquetas;
        }
    }
?>
