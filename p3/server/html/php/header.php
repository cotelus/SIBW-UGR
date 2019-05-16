<?php
    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

    echo $twig->render('headerTemplate.html');

    $_GET['amego'] = "me envío datos desde la vida";

    include("php/loginModal.php");
    include("php/signInModal.php");
?>