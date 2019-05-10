<?php
    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

    /* Hay que hacer la conexión con la base de datos y descargar los comentarios y tal
        */

    echo $twig->render('commentSectionTemplate.html');
?>