<?php 
/*  Este controlador solo va a formar la etiqueta <head> del archivo. Es útil ya que añadir o quitar hojas de estilo o archivos
    javascript se podrá hacer de una forma sencilla y añadiendo/eliminando el enlace en un solo archivo.
    Debido a que es muy poca la información que compone y que ni siquiera es visible, el controlador simplemente llama a la plantilla.
    No obstante, para ayudar a la navegación si que se pasa como parámetro al controlador un subtítulo (como "principal" "evento") 
    que aparecerá en la pestaña del navegador
*/

    require_once 'vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader,[]);


    // Se comprueba que el titulo pertenece a una lista predefinida
        // Podria rescatarse esta lista de la BBDD, pero lo veo innecesario
    $posibles = array ("PRINCIPAL", "EVENTO" , "CONTACTO");
    $headTitulo = "GAME";
    for($i = 0; $i < count($posibles); $i++){
        if($_GET['headTitulo'] == $posibles[$i]){
            $headTitulo = $posibles[$i];
            //break;
        }
    }

    echo $twig->render('headTemplate.html', ['titulo' => $headTitulo]);

?>