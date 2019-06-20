<body>
<?php 
/*  Este controlador va a generar el body de la página. Los cálculos y obtención de datos se han hecho en index.php, por tanto con la 
    información que se le pase a este archivo, se compondrá la página y llamará al resto de controladores
*/

    // Primero genera el head (Ya que este es para todos igual, no hace mucho mas, simplemente llama a su controlador y este lo genera)
    include("controllers/header.php");

    // Se va a incluir el sidebar si o si, pero hay un poco de codigo que se tiene que intercalar
    $sidebar = "controllers/sidebar.php";
    // Decide aquí si se elige el listaEvento.php, plantillaEvento.php o contacto.php
    $contenido = "controllers/listaEvento.php";
    $catalogo = true;
    if(isset($_GET['idEvento'])){
        // Compruebo simplemente que sea un numero
        if($_GET['idEvento'] > 0){
            $catalogo = false;
        }
    }



    

?>
    <!-- Como en la página, el sidebar y el contenido de la página están en una misma etiqueta, me veo en la necesidad de apartarlo de esta manera
    -->
    <div id="main">
        <?php
            // Se incluye la barra de elementos laterales
            include($sidebar);


            if($catalogo){
                $str = "<section id=\"event-list\" class=\"main-section\">";
                echo($str);

                if(isset($_GET['eventos'])){
                    $eventos = $_GET['eventos'];

                    require_once 'vendor/autoload.php';

                    $loader = new \Twig\Loader\FilesystemLoader('templates');
                    $twig = new \Twig\Environment($loader,[]);

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
                // Aquí tienes que llamar al evento
                $str = "<section id=\"event-list\" class=\"main-section\">";
                echo($str);

                if(isset($_GET['evento'])){
                    $eventos = $_GET['evento'];

                    $imagen1 = $evento[7];
                    $pie1 = $evento[8];
                    $imagen2 = $evento[9];
                    $pie2 = $evento[10];
                    $titulo = $evento[3];
                    $organizador = $evento[4];
                    $fecha = $evento[5];
                    $hora = $evento[6];
                    // Cada vez que un string tenga caracteres utf-8, hay que usar la funcion encode
                    $contenido = utf8_encode($evento[11]);

                }

                require_once 'vendor/autoload.php';

                $loader = new \Twig\Loader\FilesystemLoader('templates');
                $twig = new \Twig\Environment($loader,[]);

                // Ya que este controlador va a cargar la vista directamente, llama al ebbbento
                echo $twig->render('eventTemplate.html',
                    ['imagen1' => $imagen1, 'pie1' => $pie1, 'imagen2' => $imagen2, 'pie2' => $pie2, 'titulo' => $titulo,
                    'organizador' => $organizador, 'fecha' => $fecha, 'hora' => $hora, 'contenido' => $contenido]);


                echo("</section>");
            }
        ?>
    </div>

    <?php
        /* Aquí va a ir el footer.
        */
            include("controllers/footer.php");
    ?>
</body>