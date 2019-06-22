<?php 
/*  De forma similar con el controlador del head, este controlador solo llama a la plantilla headerTemplate.html y la genera.
    Se podría añadir información adicional o rescatar alguna información de la BBDD, pero en este caso esta información se va a mantener
    sin cambios en toda la navegación.
*/

    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[]);

    echo $twig->render('headerTemplate.html');

?>