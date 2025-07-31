<?php

    // Parametros de conexión a la base de datos

    $Usuario = 'root';
    $Password = 'Administrator123';
    $ip = '127.0.0.1'; 
    $Port = "3306" ; 
    $Database = 'complementarios_minichumbie';
    $CharSet = "utf8mb4";

    // Crear la cadena de conexión
    $Dsn  = "mysql:host=$ip;dbname=$Database;charset=$CharSet";
    
    // Iniciar la conexión a la base de datos

    try {
        $Conexion = new PDO($Dsn, $Usuario, $Password);
        $Conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit;
    }
    

?>
