<!DOCTYPE html>
<?php
   include 'includes/sesion.php';
   if (!isset($_SESSION['login'])):
       header("Location: login.php");
       exit();
   endif;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de Lubricantes - COMPLEMENTARIOS MINICHUMBIE</title>
     <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            overflow-x: hidden; /* Evita la barra de desplazamiento horizontal */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Altura mínima del viewport */
            margin: 0;
        }
        
        .z-index-1 {
            z-index: 1;
        }
        
        /* Contenido principal que ocupa el espacio disponible */
        .main-content {
            flex: 1; /* Hace que este elemento ocupe todo el espacio disponible */
        }
        
        /* Asegura que el footer esté pegado al contenido */
        footer {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    
    <!-- Navbar -->
    <?php include 'includes/navbarmin.php'; ?>

    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Sección de Fabricantes -->
        <div class="container-fluid py-4 bg-dark">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h2 class="fw-bold h2-responsive display-5 text-danger">Nuestros Fabricantes</h2>
                    <p class="lead text-white">Trabajamos con las mejores marcas del mercado</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <!-- Fabricante Esso Mobil -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden">
                        <!-- Corregido: Se añadió 'productos/' a la ruta de la imagen de fondo de Esso Mobil -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('img/Lubricantes/productos/mobil lubricantes/mobil-lubricantes.png'); background-size: cover; background-position: center;"></div>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                        <div class="card-body text-center position-relative z-index-1 text-white py-5">
                            <h3 class="card-title">Esso Mobil</h3>
                            <p class="card-text">Lubricantes de alta calidad para todo tipo de vehículos. Tecnología avanzada que garantiza la protección y rendimiento de tu motor.</p>
                            <a href="includes/error.php" class="btn btn-danger">Ver productos Esso Mobil</a>
                        </div>
                    </div>
                </div>
                
                <!-- Fabricante Terpel -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden">
                        <!-- Corregido: Se añadió 'productos/' a la ruta de la imagen de fondo de Terpel -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('img/Lubricantes/productos/terpel lubricantes/terpel-lubricantes.png'); background-size: cover; background-position: center;"></div>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                        <div class="card-body text-center position-relative z-index-1 text-white py-5">
                            <h3 class="card-title">Terpel</h3>
                            <p class="card-text">Lubricantes Terpel ofrecen soluciones confiables para el cuidado de tu vehículo, con productos desarrollados bajo los más altos estándares de calidad.</p>
                            <a href="includes/error.php" class="btn btn-danger">Ver productos Terpel</a>
                        </div>
                    </div>
                </div>
                
                <!-- Fabricante Espa -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden">
                        <!-- Corregido: Se añadió 'productos/' a la ruta de la imagen de fondo de Espa -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('img/Lubricantes/productos/Espac/espac.jpg'); background-size: cover; background-position: center;"></div>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                        <div class="card-body text-center position-relative z-index-1 text-white py-5">
                            <h3 class="card-title">Refigerantes y liquido para frenos</h3>
                            <p class="card-text">Lubricantes Espa ofrecen soluciones confiables para el cuidado de tu vehículo, con productos desarrollados bajo los más altos estándares de calidad.</p>
                            <a href="includes/error.php" class="btn btn-danger">Ver productos Espa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

    <?php include "includes/footer.php" ?>
</body>
</html>