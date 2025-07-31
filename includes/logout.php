<?php

    // =============================
    // Protección de sesión y carga de dependencias
    // =============================
    include "sesion.php";

    // Cerrar sesión y destruir la sesión actual
    session_unset(); // Elimina todas las variables de sesión   
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../login.php");
?>