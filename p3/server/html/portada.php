<!DOCTYPE html>
<html lang="es">
    <!-- Se incluye el archivo de cabecera -->
    <?php
        $_GET['pageTitle']="Portada";
        include("php/head.php");
    ?>

    <body>
        <!-- Se incluye la cabecera de la página -->
        <?php
            include("php/header.php");
        ?>

        <!-- Justo debajo de la cabecera, se añade el modal del login y de registro-->
        <?php
            include("php/loginModal.php");
        ?>
        <?php
            include("php/signInModal.php");
        ?>

        <!-- Aquí se van metiendo los componentes -->
        <div id="main">
            <?php
                include("php/aside.php");
            ?>
        <!-- La sección "principal" en la que van los eventos, si se genera en la portada -->
            <section id="event-list" class="main-section">
                
                <?php
                    include("php/eventCatalog.php");
                ?>
            </section>
        </div>

        <?php
            include("php/footer.php");
        ?>
    </body>
</html>