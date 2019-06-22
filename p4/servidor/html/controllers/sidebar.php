<?php 
/* Aunque se podrá cambiar el contenido de la barra lateral, aun no
*/

    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[]);


    // Cargo las etiquetas y compruebo que $_GET['etiquetas'] es un array
    if(isset($_GET['etiquetas']) && is_array($_GET['etiquetas'])){
        $etiquetas = $_GET['etiquetas'];
    }else{
        // Si la comprobación anterior no surte efecto, creo un array vacio para que no de fallos el controlador
        $etiquetas = array();
    }

    // Cargo los enlaces de interés y las etiquetas
    echo '<aside id="widgets">';
    echo '<ul>';
    echo $twig->render('sidebarTemplate.html');
    echo $twig->render('tagSectionTemplate.html', array(
        'tags' => $etiquetas));
    echo '</ul>';
    echo '</aside>'

?>