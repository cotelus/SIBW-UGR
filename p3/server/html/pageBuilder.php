<!-- Este .php es básicamente la plantilla principal. Se muestran varias cosas predefinidas, para que se le pasen al controlador.

    La intención de este archivo es de servir como base para hacer copy/paste del mismo y rellenar archivos mejor y mas rápido -->

<!DOCTYPE html>
<html lang="es">
    <!-- Se incluye el archivo de cabecera -->
    <?php
        $_GET['pageTitle']="Página";
        include("php/head.php");
    ?>

    <body>
        <!-- Se incluye la cabecera de la página -->
        <?php
            include("php/header.php");
        ?>

        <!-- Aquí se van metiendo los componentes -->

        <?php
            include("php/eventCatalog.php");
        ?>

        <?php
            include("php/footer.php");
        ?>
    </body>
</html>