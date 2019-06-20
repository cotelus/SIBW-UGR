<!-- Entiendo que aunque en este fichero no se genere ningún tipo de HTML, ya que va a ser el encargado de albergar el resto de controladores
    y funcionalidad, si que debo crear e inicializar la etiqueta <html> -->
<html>

<?php
    /*  Aquí se van a incluir las clases que sean necesarias 
    */
    require("models/conectarBaseDatos.php");

    /********************************************************************************************/


    /*  Aquí van a ir las comprobaciones sobre lo que se está recibiendo en la URL */
    // Si ?id=[0-10] -> carga la página del evento que sea
    $cargaEvento = false;
    if (isset($_GET['idEvento'])) {
        $cargaEvento = true;
        $idEvento = $_GET['idEvento'];
    }

    // Si ?contacto -> carga la página de contacto

    // Cualquier otra cosa -> index.php

    /********************************************************************************************/


    /* 
    Aquí se van a hacer las consultas a BD iniciales.
        1.- Obtener el evento o datos de la página en cuestión según lo establecido en la URL
            1.1.- Si lo obtenido era un evento, cargar también los comentarios y las palabras prohibidas
    */
    // Si no hay ningún evento seleccionado en la URL, voy a cargar todos los eventos de la base de datos
    if(!$cargaEvento){
        // Le pido al modelo que me devuelva todos los eventos

        $eventos = ConectarABaseDatos::getAllEvents();
    }else{
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
    // Como prueba le paso solo un id de un evento
    $_GET['idEvento'] = $idEvento;
    $_GET['eventos'] = $eventos;
    $_GET['evento'] = $evento;
    include("controllers/bodyGenerator.php");    
?>

</html>
