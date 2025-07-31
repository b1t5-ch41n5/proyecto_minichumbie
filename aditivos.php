
<!DOCTYPE html>

<?php
   // =============================
   // Protección de sesión: Solo usuarios autenticados pueden acceder
   // =============================
   include 'includes/sesion.php'; // Inicia la sesión PHP
   if (!isset($_SESSION['login'])): // Si no hay sesión iniciada, redirige al login
       header("Location: login.php");
       exit();
   endif;
   // =============================
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aditivos - Complementarios Minichumbie</title>
     <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* =============================
           Estilos generales y layout principal
        ============================== */
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        
        .z-index-1 {
            z-index: 1;
        }
        
        .main-content {
            flex: 1;
        }
        
        footer {
            margin-top: 0;
        }

        /* =============================
           Loader de página: animación de carga
        ============================== */
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background: linear-gradient(135deg, #1a0f0b 0%, #2c1810 50%, #3d2317 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #loader {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 215, 0, 0.3);
            border-top: 4px solid #ffd700;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            position: relative;
        }

        #loader::after {
            /* Icono de matraz en el centro del loader */
            content: '⚗️';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader-section {
            position: fixed;
            top: 0;
            width: 51%;
            height: 100%;
            background: linear-gradient(135deg, #2c1810, #3d2317);
            z-index: 1001;
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .section-left {
            left: 0;
        }

        .section-right {
            right: 0;
        }

        body.loaded .section-left {
            transform: translateX(-100%);
        }

        body.loaded .section-right {
            transform: translateX(100%);
        }

        body.loaded #loader-wrapper {
            visibility: hidden;
            transform: translateY(-100%);
            transition: all 0.3s 1s ease-out;
        }

        /* =============================
           Header Section: cabecera de la página
        ============================== */
        .header-section {
            background: linear-gradient(135deg, #1a0f0b 0%, #2c1810 50%, #3d2317 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            /* Gradientes decorativos en el fondo del header */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 70%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(220, 53, 69, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .header-title {
            font-size: 3.5rem;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .header-subtitle {
            font-size: 1.3rem;
            color: #ffd700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .header-description {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            z-index: 2;
        }

        /* Categories Section - Mismo estilo que home.php */
        .categories-section {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #0f0f0f 100%);
            position: relative;
            padding: 80px 0;
        }

        .categories-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(220, 53, 69, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .category-panel {
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            transition: all 0.4s ease;
            border: 2px solid transparent;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .category-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 2;
        }

        .category-panel:hover::before {
            opacity: 1;
        }

        .category-panel:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(255, 215, 0, 0.5);
            box-shadow: 0 25px 50px rgba(220, 53, 69, 0.2);
        }

        .category-bg {
            transition: transform 0.4s ease;
            z-index: 1;
        }

        .category-panel:hover .category-bg {
            transform: scale(1.1);
        }

        .category-overlay {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(28, 16, 10, 0.7) 100%);
            z-index: 3;
            transition: all 0.4s ease;
        }

        .category-panel:hover .category-overlay {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(28, 16, 10, 0.5) 100%);
        }

        .category-content {
            z-index: 4;
            transition: all 0.4s ease;
        }

        .category-panel:hover .category-content {
            transform: translateY(-5px);
        }

        .category-title {
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .category-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ff6b35);
            transition: width 0.4s ease;
        }

        .category-panel:hover .category-title::after {
            width: 80%;
        }

        .category-description {
            font-size: 1.1rem;
            margin-bottom: 25px;
            opacity: 0.9;
            transition: all 0.4s ease;
        }

        .category-panel:hover .category-description {
            opacity: 1;
            transform: translateY(-2px);
        }

        .category-btn {
            background: linear-gradient(45deg, #dc3545, #ff6b35);
            border: none;
            border-radius: 50px;
            padding: 15px 35px;
            font-weight: bold;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            position: relative;
            overflow: hidden;
        }

        .category-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .category-btn:hover::before {
            left: 100%;
        }

        .category-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255, 215, 0, 0.4);
            background: linear-gradient(45deg, #ffd700, #ff6b35);
            color: #000;
            text-decoration: none;
        }

        .category-icon {
            font-size: 1.3rem;
            transition: transform 0.4s ease;
        }

        .category-btn:hover .category-icon {
            transform: translateX(5px);
        }

        /* Efectos de partículas flotantes */
        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #ffd700;
            border-radius: 50%;
            opacity: 0.4;
            animation: float 8s infinite linear;
        }

        .particle:nth-child(2) { left: 20%; animation-delay: -2s; background: #ff6b35; }
        .particle:nth-child(3) { left: 40%; animation-delay: -4s; background: #dc3545; }
        .particle:nth-child(4) { left: 60%; animation-delay: -1s; background: #ffd700; }
        .particle:nth-child(5) { left: 80%; animation-delay: -3s; background: #ff6b35; }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.4;
            }
            90% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-title {
                font-size: 2.5rem;
            }
            
            .category-title {
                font-size: 2.2rem;
            }
            
            .category-panel {
                margin-bottom: 30px;
            }
            
            .categories-section {
                padding: 50px 0;
            }
        }

        @media (max-width: 576px) {
            .header-title {
                font-size: 2rem;
            }
            
            .category-title {
                font-size: 1.8rem;
            }
            
            .category-btn {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- =============================
         Loader de página: animación de carga mientras se muestra la web
    ============================== -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    
    <!-- =============================
         Barra de navegación principal
         Incluye el menú superior reutilizable
    ============================== -->
    <?php include 'includes/navbarmin.php'; ?>

    <!-- =============================
         Contenido principal de la página
    ============================== -->
    <div class="main-content">
        <!-- =============================
             Header Section: cabecera con título y descripción
        ============================== -->
        <div class="header-section">
            <div class="container text-center">
                <h1 class="header-title">
                    <i class="fas fa-flask me-3" style="color: #ffd700;"></i>
                    Aditivos Automotrices
                </h1>
                <p class="header-subtitle">Mejora el rendimiento de tu vehículo</p>
                <p class="header-description">Productos especializados para optimizar el funcionamiento de tu motor</p>
            </div>
        </div>

        <!-- =============================
             Sección de fabricantes de aditivos
             Cada tarjeta representa un fabricante distinto
        ============================== -->
        <div class="container-fluid py-5 bg-dark categories-section">
            <!-- Partículas flotantes decorativas -->
            <div class="floating-particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>
        
            <div class="row justify-content-center">
                <!-- =============================
                     Tarjeta de fabricante CRC
                ============================== -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden">
                        <!-- Imagen de fondo del fabricante CRC -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('img/Aditivos/crc/logo.jpg'); background-size: cover; background-position: center;"></div>
                        <!-- Capa oscura para mejorar la legibilidad del texto -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                        <div class="card-body text-center position-relative z-index-1 text-white py-5">
                            <h3 class="card-title">CRC Aditivos</h3>
                            <p class="card-text">Marca destinada a producir y comercializar productos para consumo masivo. Cuenta con dos unidades de negocio: Cuidado del hogar y Cuidado del vehículo y la industria.</p>
                            <a href="includes/catalogo?id=1" class="btn btn-danger">Ver productos Esso Mobil</a>
                        </div>
                    </div>
                </div>
                <!-- =============================
                     Tarjeta de fabricante Petrolabs
                ============================== -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden">
                        <!-- Imagen de fondo del fabricante Petrolabs -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('img/Aditivos/petrolabs/logo.jpg'); background-size: cover; background-position: center;"></div>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                        <div class="card-body text-center position-relative z-index-1 text-white py-5">
                            <h3 class="card-title">Petrolabs</h3>
                            <p class="card-text">Especializada en la fabricación y comercialización de aditivos para combustibles, tanto para vehículos como para aplicaciones industriales. Sus productos están diseñados para mejorar el rendimiento del motor, reducir el consumo de combustible, limpiar los inyectores y eliminar el agua condensada en el tanque.</p>
                            <a href="includes/catalogo?id=2" class="btn btn-danger">Ver productos Terpel</a>
                        </div>
                    </div>
                </div>
                <!-- =============================
                     Tarjeta de fabricante Simoniz
                ============================== -->
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm position-relative overflow-hidden">
                        <!-- Imagen de fondo del fabricante Simoniz -->
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('img/Aditivos/simoniz/logo.jpg'); background-size: cover; background-position: center;"></div>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                        <div class="card-body text-center position-relative z-index-1 text-white py-5">
                            <h3 class="card-title">Simoniz</h3>
                            <p class="card-text">Produce una variedad de otros productos de limpieza y cuidado automotriz, como limpiadores de llantas, limpiadores multiusos y productos para el cuidado del interior del vehículo.</p>
                            <a href="includes/catalogo?id=3" class="btn btn-danger">Ver productos Espa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- =============================
         Scripts y plugins adicionales
    ============================== -->
    <script src="js/plugins.js"></script>
    <script>
        // Cuando la página termina de cargar, agrega la clase 'loaded' al body para ocultar el loader
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

    <!-- =============================
         Footer reutilizable
    ============================== -->
    <?php include "includes/footer.php" ?>
</body>
</html>