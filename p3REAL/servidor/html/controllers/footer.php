<?php 
/*  Este es otro controlador que por el contenido estático a la vez que escaso, solo llama a la plantilla y la rellena
*/

    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[]);

    echo $twig->render('footerTemplate.html');

?>