<?php 
/* Aunque se podrá cambiar el contenido de la barra lateral, aun no
*/

    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[]);

    if(isset($_GET['idEvento'])){
        print("HOLA AMIGOOOOO");
        echo $twig->render('listaEventoTemplate.html');
    }

?>