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
            /* 
                En la cabecera además va a ir el control de sesiones de usuario. Es decir, el usuario que se conecte lo hará a través
                del botón de "INICIAR SESIÓN" del header. Acto seguido si el inicio es válido, la página que se muestre, almacenará 
                ( o no, aunque el header si que lo va a enviar con GET ) el usuario y el e-mail. 
            */

            include("php/header.php");
        
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