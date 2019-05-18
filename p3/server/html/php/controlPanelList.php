<?php
    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[ ]);

    // Hacer las comprobaciones de los permisos que tiene el usuario y cargar los módulos del mismo en funcion de lo que pueda

    echo $twig->render('controlPanelListUserConfigTemplate.html');
    echo $twig->render('controlPanelListModeratorConfigTemplate.html');
?>