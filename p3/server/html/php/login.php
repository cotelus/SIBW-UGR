<?php

    // Comprobar que los datos de usuario son correctos
    $conexion = mysqli_connect('localhost', 'admin', 'sibw1819', "SIBW_bd");

    // Se abre la base de datos
    //$abreBD = mysqli_select_db('SIBW_bd', $conexion);
    if(!$conexion){
        die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
    }

    // Se comprueba que se han recibido los datos
    
    if(isset($_POST["email"])){
        $email = $_POST['email'];
    }else{ 
        header('Location: /portada.php');
    }

    if(isset($_POST["pass"])){
        $pass = $_POST['pass'];
    }else{ 
        header('Location: /portada.php');
    }

    $seleccion = "SELECT * FROM user WHERE email = '{$email}'";

    $resultado = mysqli_query($conexion, $seleccion);

    $fila = mysqli_fetch_array($resultado);


    // Si los datos son correctos, con session se crea una variable global usuario y se mantiene lo que dure la navegación
    if($pass == $fila[2]){
        $userId = $fila[1];
        $name = $fila[3];
        $type = $fila[4];
        
        $usuario = new User($email, $userId, $name, $type);
        session_start();
        $_SESSION['usuario'] = $usuario;
    }

    mysqli_close($conexion);

    



    // Si los datos son correctos, con session se crea una variable global usuario y se mantiene lo que dure la navegación



    //Redirige a la portada (estaría bien que redirigiera a la página que se estaba visitando)
    header('Location: /portada.php');


?>
