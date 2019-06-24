<!-- Entiendo que aunque en este fichero no se genere ningún tipo de HTML, ya que va a ser el encargado de albergar el resto de controladores
    y funcionalidad, si que debo crear e inicializar la etiqueta <html> -->
<html>

<?php
    header("Content-Type: text/html;charset=utf-8");
    /*  Aquí se van a incluir las clases que sean necesarias 
    */
    require("models/conectarBaseDatos.php");
    include_once 'class/usuario.php';
    include_once 'class/userSession.php';
    include_once 'models/modeloUsuarios.php';


    $userSession = new UserSession();
    $user = new Usuario();

    /********************************************************************************************/


    /*  Aquí van a ir las comprobaciones sobre lo que se está recibiendo en la URL */
    // Si ?id=[0-10] -> carga la página del evento que sea
    $cargaEvento = false;
    if (isset($_GET['idEvento'])) {
        $cargaEvento = true;
        $idEvento = $_GET['idEvento'];
    }

    // Si ?contacto -> carga la página de contacto

    // Si ?tag -> carga la visión de los eventos con tal etiqueta
    $cargaTag = false;
    if (isset($_GET['tag'])) {
        $cargaTag = true;
        $tagName = $_GET['tag'];
    }

    // Si ?print -> carga la versión para imprimir del evento
    $imprime = false;
    if (isset($_GET['print'])) {
        $imprime = true;
        // Se sobreescribe la información de idEvento, ya que como el evento es el mismo, lo unico que cambia es la representación de la información
        $idEvento = $_GET['print'];
    }

    // Si login=true -> carga la versión para loguearse en el sistema
    if (isset($_GET['login'])) {
        $isLoggingIn = $_GET['login'];
    }
    // Si register=true -> carga la versión para registrarse en el sistema
    if (isset($_GET['register']) && $_GET['register'] == true) {
        $isRegisterIn = true;
    }
    // Si el usuario quiere acceder a la administración del perfil
    if (isset($_GET['profileAdmin']) && $_GET['profileAdmin'] == true) {
        $profileAdmin = true;
    }

    if (isset($_GET['comentarioEnviado'])) {
        if( $_GET['comentarioEnviado'] == 0 ){
            echo "<script type=\"text/javascript\">alert(\"Comentario enviado y almacenado correctamente :D\");</script>";  
        }else{
            echo "<script type=\"text/javascript\">alert(\"Ha habido un fallo enviando el comentario. Inténtalo de nuevo en un rato.\");</script>";
        }
        
    }


    // Comprobaciones para la sesión de usuario
    if (isset($_GET['logout'])) {
        //$userSession = new UserSession();
        $userSession->closeSession();

        header("location: /index.php");
    }
    if(isset($_SESSION['user'])){
        // Este mensaje es de prueba solo
        //echo "Hay sesión";
        echo $userSession->getCurrentUser()->toString();
    }else if(isset($_POST['login']) && isset($_POST['formularioLogin'])){
        $pruebaLogin = $_POST['login'];

        $userForm = $pruebaLogin[0];
        $passForm = $pruebaLogin[1];

        if($user->userExist($userForm, $passForm)){
            // Esto hace que podamos almacenar los datos del usuario de manera local, y así no colapsar las peticiones a BD y al servidor
            $user->setUser($userForm);
            $userSession->setCurrentUser($user);
            header("Location: /index.php");
        }else{
            // Si hemos llegado aquí es que el usuario y/o contraseña no son buenos, se envia de nuevo a la pantalla de login
            header("Location: /index.php?login=0");
        }
    }else{
        echo "No hay sesión";
    }

    // Cualquier otra cosa -> index.php

    /********************************************************************************************/


    /* 
    Aquí se van a hacer las consultas a BD iniciales.
        1.- Obtener el evento o datos de la página en cuestión según lo establecido en la URL
            1.1.- Si lo obtenido era un evento, cargar también los comentarios y las palabras prohibidas
    */
    // Ya que las etiquetas se van a mostrar en todas las vistas, se cargan si o si
    $etiquetas = ConectarABaseDatos::getAllTags();

    // Si no hay ningún evento seleccionado en la URL, voy a cargar todos los eventos de la base de datos
    if(!$cargaEvento){
        // Le pido al modelo que me devuelva todos los eventos
        /*  Como sintácticamente es lo mismo la pagina principal que ver todos los eventos de X etiqueta,
                aquí lo que hago es marcar una distinción y pasarle al controlador que va a generar la vista el array de eventos,
                solo que en una ocasión tendrá todos los eventos y en otra ocasión solo los de la etiqueta.
        */
        if($cargaTag){
            $eventos = ConectarABaseDatos::getAllEventsFromTag($tagName);
        }else{
            $eventos = ConectarABaseDatos::getAllEvents();
        }
    }else{
        $evento = ConectarABaseDatos::getEvent($idEvento);
        // Además, habrá que cargar los comentarios del mismo
        $comentariosEvento = ConectarABaseDatos::getComments($idEvento);
    }
    if($imprime){
        $evento = ConectarABaseDatos::getEvent($idEvento);
    }


    /********************************************************************************************/


    /*  Aquí, con los datos recogidos ya, va a ir la lógica sobre lo que finalmente se mostrará. 
        Es decir, se van a tratar los datos que se han recogido.
    */
    // Se decide qué va a aparecer como título
    // how to use
    $headTitulo = "PRINCIPAL";

    // En este caso, plantillaEvento.php puede ser un controlador que cree la visión del evento, y listaEventos.php que sea el controlador
    // que genere la vista de todos los eventos

    /********************************************************************************************/


    /* Aquí, finalmente se llama a los controladores pertinentes con la información pertinente 
    */

    // Aquí se pasa por parámetro al controlador de la cabecera el título que esta va a llevar
    $_GET['headTitulo']= $headTitulo;
    include("controllers/head.php");

    /*  Se llama al controlador que va a cargar el body de la página, aunque para ello se le pasa la información:
            1: Se pasa un vector de booleanos en los que cada posición supondrá un controlador
                B0: True -> Se carga el controlador de la lista de eventos
                B1: True -> Se carga el controlador de un evento concreto
            2: Se pasa un vector de vectores con la información pertinente.
                V0: Vector con la información de las miniaturas de los eventos
                V1: Vector con la información de un evento concreto
    */
    // Como prueba por ahora, paso todos los objetos en bruto
    // Como extra, imprime un alert si un comentario enviado ha sido bien enviado

    $_GET['idEvento'] = $idEvento;
    $_GET['eventos'] = $eventos;
    $_GET['evento'] = $evento;
    $_GET['comentarios'] = $comentariosEvento;
    $_GET['etiquetas'] = $etiquetas;
    include("controllers/bodyGenerator.php"); 
?>

</html>
