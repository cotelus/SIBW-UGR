<?php
    include_once '/class/userSession.php';

    // Se cierra la sesión
    //$userSession = new UserSession();
    //$userSession->closeSession();

    // Se vuelve al index.php
    header("location: /index.php");

?>