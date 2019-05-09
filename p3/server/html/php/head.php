<?php
    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

   $pageTitle = $_GET['pageTitle'];

    echo $twig->render('headTemplate.html',  ['pageTitle' => $pageTitle]);

?>