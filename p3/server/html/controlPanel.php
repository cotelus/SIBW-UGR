<!DOCTYPE html>
<html lang="es">
    <!-- Se incluye el archivo de cabecera -->
    <?php
        $_GET['pageTitle']="Panel de usuario";
        include("php/head.php");
    ?>

    <body>
        <!-- Se incluye la cabecera de la página -->
        <?php
            include("php/header.php");
        ?>

        <!-- Aquí se van metiendo los componentes -->
        <div id="main">
        <!-- La sección en la que van los ajustes de usuario -->
            <section id="event-list" class="panel-control-content">
                
                <!-- Aquí en lugar del catálogo de eventos, obviamente tiene que ir los tejemanejes de la configuracion -->
                <?php
                    session_start(); //Never forget this line when using $_SESSION
                    $queue = $_SESSION['queue'];
                    //use queue for your needs
                    echo $queue;


                    include("php/controlPanelList.php");
                ?>
            </section>
        </div>

        <?php
            include("php/footer.php");
        ?>
    </body>
</html>