<!DOCTYPE html>
<html lang="es">
    <!-- Se incluye el archivo de cabecera -->
    <?php
        $_GET['pageTitle']="Evento";
        include("php/head.php");
    ?>

    <body>
        <!-- Se incluye la cabecera de la página -->
        <?php
            include("php/header.php");
        ?>

        <?php
            include("php/commentSection.php");
        ?>

        <!-- Aquí se van metiendo los componentes -->
        <div id="main">
            <?php
                include("php/aside.php");
            ?>
        <!-- La sección "principal" en la que van los eventos, si se genera en la portada -->
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