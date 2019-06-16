<?php

    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

    echo $twig->render('headerTemplate.html');

    include("php/loginModal.php");
    include("php/signInModal.php");
?>