<?php
    include("/models/conectarBaseDatos.php");

    class ModeloUsuarios{

        // Comprueba que el usuario que se pasa por parámetros está dado de alta en el sistema
        static function checkUser($user, $pass){
            // Uso el modelo de conexión a Base de datos para tenerlo todo centralizado
            $conexion = ConectarABaseDatos::makeConnectionAdmin();
            
            $seleccion = "SELECT * FROM usuario WHERE username = '{$user}' AND password = '{$pass}'";

            $resultado = mysqli_query($conexion, $seleccion);
            
            // Si devuelve alguna fila, es que el usuario y contraseña son correctos
            $numFilas = mysqli_num_rows($resultado);

            ConectarABaseDatos::closeConnection($conexion);

            return $numFilas;
        }

        static function getUser($user){
            $conexion = ConectarABaseDatos::makeConnectionAdmin();

            $seleccion = "SELECT * FROM usuario WHERE username = '{$user}'";

            $resultado = mysqli_query($conexion, $seleccion);
            
            $usuario = array();
            $fila = $resultado->fetch_assoc();
            array_push($usuario, $fila['username'], $fila['correo'], $fila['nombreReal'], $fila['esModerador']
            , $fila['esGestor'] , $fila['esSuper']);

            ConectarABaseDatos::closeConnection($conexion);

            return $usuario;
        }
    }
?>