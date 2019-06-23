<?php
    // Una función sencilla para sacar la ip del lado cliente
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    // Comprueba que en efecto el formulario se ha enviado por post
    if ( isset( $_POST['submit'] ) ) {

        //$comentario = $_POST['submit'];
        $comentario = $_POST['comment'];

        if ( isset( $_GET['idEvento'] ) ){
            $idEvento = $_GET['idEvento'];
        }

        $ip = getUserIpAddr();
        $nombreUsuario = utf8_encode($comentario[0]);
        $email = utf8_encode($comentario[1]);
        $Date = new DateTime("now", new DateTimeZone('Europe/Madrid'));
		$Date = $Date->format('Y-m-d');
		$Time = new DateTime("now", new DateTimeZone('Europe/Madrid'));
        $Time = $Time->format('H:i:s');
        $text = utf8_encode($comentario[2]);

        // Se conecta con el servidor, con un usuario administrador
        $conexion = mysqli_connect('localhost', 'administrador', 'admin123', "sibw");
        mysqli_query("SET NAMES 'utf8'");

        if(!$conexion){
            die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
        }

        $seleccion = "INSERT INTO comentario (evento, ip, nombreUsuario, email, date, time, text) VALUES ('{$idEvento}', '{$ip}', '{$nombreUsuario}', '{$email}', '{$Date}', '{$Time}', '{$text}')";

        //$resultado = mysql_query ($seleccion, $conexion);
        $resultado = mysqli_query($conexion, $seleccion);

        //$seleccion = true;
        if($seleccion){
            echo mysqli_error($conexion);
            mysqli_close($connection);
            // Esto es para que me devuelva a la página anterior y así dar la sensación de que todo bien
            //echo '<body onLoad="history.go(-1);">';
            header("Location: /index.php?idEvento=$idEvento&comentarioEnviado=true");

		}
    }
?>