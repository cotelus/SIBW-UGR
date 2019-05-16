<!DOCTYPE html>
<html lang="es">
    <!-- Se incluye el archivo de cabecera -->
    <?php
        $_GET['pageTitle']="Evento";
        include("php/head.php");
    ?>

    <body>
        <!-- cabecera de la página -->
        <?php
            include("php/header.php");
        ?>

        <!-- Añado aquí el contenido para manejar los comentarios -->
        <?php
            include("php/commentSection.php");
        ?>

        <div id="main">
            <?php
                include("php/aside.php");
            ?>
        <!-- El evento en profundidad -->
            <section id="event-list" class="main-section">
                
                <?php
                    include("php/eventFull.php");
                ?>
            </section>
        </div>

        <?php
            include("php/footer.php");
        ?>
    </body>
</html>