<body>
<?php 
/*  Este controlador va a generar el body de la página. Los cálculos y obtención de datos se han hecho en index.php, por tanto con la 
    información que se le pase a este archivo, se compondrá la página y llamará al resto de controladores
*/
    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

    // Primero genera el head (Ya que este es para todos igual, no hace mucho mas, simplemente llama a su controlador y este lo genera)
    // También le digo que si hay que imprimir, no coja la cabecera, ya que va a cambiar
    if(!isset($imprime) || $imprime == false){
        include("controllers/header.php");
        // Se va a incluir el sidebar si o si, pero hay un poco de codigo que se tiene que intercalar
        $sidebar = "controllers/sidebar.php";
    }
        
    // Decide aquí si se elige el listaEvento.php, plantillaEvento.php o qué pestaña
    $contenido = "controllers/listaEvento.php";
    $catalogo = true;
    // Si se carga un evento en concreto se pone a false el catálogo (página principal)
    if(isset($_GET['idEvento'])){
        // Compruebo simplemente que sea un numero
        if( is_numeric($_GET['idEvento'] ) ){
            $idEvento = $_GET['idEvento'];
            $catalogo = false;
            $eventoConcreto = true;
        }
    }

    // De manera excepcional, como los comentarios son un botón desplegable situado siempre en el mismo sitio, lo pongo aquí, debajo del header
    if(!$catalogo && isset($_GET['comentarios'])){

        $comentarios = $_GET['comentarios'];
        
        echo $twig->render('commentSectionTemplate.html', array('comments' => $comentarios, 'idEvento' => $idEvento));
        //echo $twig->render('commentSectionTemplate.html', array('comments' => $comentarios));
    }

    $imprimir = false;
    // Primero compruebo si se trata de un evento para imprimir, si es el caso, se carga la versión para imprimir, en otro caso, se carga la versión pertinente
    //if(isset($_GET['imprimir']) && $_GET['imprimir']==true){
    if(isset($imprime) && $imprime == true){
        $imprimir = $imprime;
        if(isset($_GET['evento'])){
            $evento = $_GET['evento'];

            $idEvento = $evento[0];
            $imagen1 = utf8_encode($evento[7]);
            $pie1 = utf8_encode($evento[8]);
            $imagen2 = utf8_encode($evento[9]);
            $pie2 = utf8_encode($evento[10]);
            $titulo = utf8_encode($evento[3]);
            $organizador = utf8_encode($evento[4]);
            $fecha = utf8_encode($evento[5]);
            $hora = utf8_encode($evento[6]);
            $contenido = utf8_encode($evento[11]);

        }

        // Ya que este controlador va a cargar la vista directamente, llama al evento
        echo $twig->render('printEventTemplate.html',
            ['imagen1' => $imagen1, 'pie1' => $pie1, 'imagen2' => $imagen2, 'pie2' => $pie2, 'titulo' => $titulo,
            'organizador' => $organizador, 'fecha' => $fecha, 'hora' => $hora, 'contenido' => $contenido, 
            'idEvento' => $idEvento]);
    }

    if(!$imprimir){
        echo '<div id="main">';

        // Si me estoy registrando/logueando, quiero mostrar una vista solo para esa actividad
        if( isset($isLoggingIn) || isset($isRegisterIn) ) {
            if(isset($isLoggingIn) && $isLoggingIn){
                echo $twig->render('loginTemplate.html');
            }else if (isset($isLoggingIn) && !$isLoggingIn){
                $errorLogin = "Usuario y/o contraseña incorrectos. Inténtelo de nuevo";
                echo "<script type=\"text/javascript\">alert(\"$errorLogin\");</script>";
                echo $twig->render('loginTemplate.html');
            }else if (isset($isRegisterIn) && $isRegisterIn){
                echo $twig->render('registerTemplate.html');
            }

        }
        // Este es por si hay que ir a la administración del perfil, el cual tendrá opciones extra
        else if((isset($profileAdmin) && $profileAdmin == true)){
           echo $twig->render('profileAdminTemplate.html');
        }
        
        else{
            // Se incluye la barra de elementos laterales
            // Compruebo que se han recibido los nombres de las etiquetas
            if(isset($_GET['etiquetas'])){
                $etiquetas = $_GET['etiquetas'];
            }

            include($sidebar);

            if($catalogo){
                $str = "<section id=\"event-list\" class=\"main-section\">";
                echo($str);

                if(isset($_GET['eventos'])){
                    $eventos = $_GET['eventos'];

                    // numero de eventos recuperados:
                    $numEventos = $eventos[0];

                    for($i = 0; $i < $numEventos*3; $i+=3){
                        $idEvento = $eventos[$i + 1];
                        $nombre = $eventos[$i + 2];
                        $imagenPortada = $eventos[$i + 3];

                        echo $twig->render('listaEventoTemplate.html',
                            ['idEvento' => $idEvento, 'eventName' => $nombre, 'titleImg' => $imagenPortada]);
                    }
                }

                require_once 'vendor/autoload.php';

                /*
                $loader = new \Twig\Loader\FilesystemLoader('templates');
                $twig = new \Twig\Environment($loader,[]);

                echo $twig->render('listaEventoTemplate.html',
                    ['idEvento' => $idEvento, 'eventName' => $nombre, 'titleImg' => $imagenPortada]);

                    */


                echo("</section>");
            }
            else{
                $str = "<section id=\"event-list\" class=\"main-section\">";
                echo($str);

                if(isset($_GET['evento'])){
                    $evento = $_GET['evento'];

                    $idEvento = utf8_encode($evento[0]);
                    $imagen1 = utf8_encode($evento[7]);
                    $pie1 = utf8_encode($evento[8]);
                    $imagen2 = utf8_encode($evento[9]);
                    $pie2 = utf8_encode($evento[10]);
                    $titulo = utf8_encode($evento[3]);
                    $organizador = utf8_encode($evento[4]);
                    $fecha = utf8_encode($evento[5]);
                    $hora = utf8_encode($evento[6]);
                    $contenido = utf8_encode($evento[11]);
                    $TWLink = utf8_encode($evento[12]);
                    $FBLink = utf8_encode($evento[13]);
                    $etiquetas = $evento[14];

                }

                // Ya que este controlador va a cargar la vista directamente, llama al ebbbento
                echo $twig->render('eventTemplate.html',
                    ['imagen1' => $imagen1, 'pie1' => $pie1, 'imagen2' => $imagen2, 'pie2' => $pie2, 'titulo' => $titulo,
                    'organizador' => $organizador, 'fecha' => $fecha, 'hora' => $hora, 'contenido' => $contenido, 
                    'TWLink' => $TWLink, 'FBLink' => $FBLink, 'etiquetas' => $etiquetas, 'idEvento' => $idEvento]);

                echo("</section>");
            }
        }
        echo '</div>';
    }

    /* Aquí va a ir el footer.
    */
    include("controllers/footer.php");
?>
</body>