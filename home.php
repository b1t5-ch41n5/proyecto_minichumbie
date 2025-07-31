<!DOCTYPE html>
<html lang="en">

<?php 
    include 'includes/sesion.php';
    if (!isset($_SESSION['login'])):
        header("Location: login.php");
        exit();
    endif;

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPLEMENTARIOS MINICHUMBIE</title>
     <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
    /* Estilos personalizados para home de estación de combustible */
    body {
        background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Loader mejorado */
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
        content: '⛽';
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

    /* Hero Section mejorado */
    .hero-section {
        position: relative;
        overflow: hidden;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 70%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 30%, rgba(220, 53, 69, 0.1) 0%, transparent 50%);
        z-index: 2;
    }

    .hero-overlay {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(28, 16, 10, 0.8) 100%);
        z-index: 3;
    }

    .hero-content {
        z-index: 4;
        animation: fadeInUp 1s ease-out;
    }

    .hero-title {
        font-size: 3.3rem;
        font-weight: 500;
        color: #f1f1f1;
        text-shadow: 
            0 1px 0 rgba(255,255,255,0.1),
            0 2px 4px rgba(0,0,0,0.6);
        letter-spacing: 2px;
        margin-bottom: 20px;
        position: relative;
    }

    .hero-title:hover {
        color: #ffd700;
        transition: color 0.3s ease;
    }

    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(255, 215, 0, 0.8)); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Sección de categorías mejorada */
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
        .hero-title {
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
        .hero-title {
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

<!--
    
TemplateMo 556 Catalog-Z

https://templatemo.com/tm-556-catalog-z

-->
</head>
<body >
    
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <?php include 'includes/navbarmin.php'; ?>

    <!--
    h-50 sets height it takes
              -->
    <div class="hero-section position-relative" style="height: 400px; background-image: url('img/main.jpg'); background-size: cover; background-position: center;">
        <!-- Capa oscura encima de la imagen con mayor opacidad -->
        <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay"></div>
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-center p-5 flex-column hero-content">
            <div class="hero-badge mb-3" style="background: rgba(255, 215, 0, 0.2); padding: 10px 25px; border-radius: 50px; border: 2px solid #ffd700;">
                <span style="color: #ffd700; font-weight: bold;">⛽ ESTACIÓN AUTORIZADA</span>
            </div>
            <h1 class="hero-title mb-3">BIENVENIDO A COMPLEMENTARIOS MINICHUMBIE</h1>
            <p class="lead mb-4" style="font-size: 1.3rem; color: #ff6b35; font-weight: bold;">Complementarios Automotrices Premium</p>
            <p class="mb-4" style="font-size: 1.1rem; opacity: 0.9;">Más de 10 años de experiencia en el sector</p>
        </div>
    </div>


  <!-- Sección de categorías principales después del hero section -->
    <div class="container-fluid py-5 bg-dark categories-section">
        <!-- Partículas flotantes -->
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        
        <div class="row">
            <!-- Panel de Lubricantes -->
            <div class="col-md-6 mb-4">
                <div class="category-panel position-relative rounded overflow-hidden shadow" style="height: 300px;">
                    <!-- Imagen de fondo para lubricantes -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 category-bg" style="background-image: url('img/lubricantes.jpg'); background-size: cover; background-position: center;"></div>
                    
                    <!-- Capa oscura para mejorar legibilidad -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 category-overlay"></div>
                    
                    <!-- Contenido del panel -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-center p-4 category-content">
                        <div>
                            <h2 class="category-title">Lubricantes</h2>
                            <p class="category-description">Explora nuestra selección de lubricantes de alta calidad para todo tipo de vehículos</p>
                            <a href="lubricantes.php" class="category-btn">
                                <i class="fas fa-oil-can category-icon"></i>
                                Ver Productos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Panel de Aditivos -->
            <div class="col-md-6 mb-4">
                <div class="category-panel position-relative rounded overflow-hidden shadow" style="height: 300px;">
                    <!-- Imagen de fondo para aditivos -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 category-bg" style="background-image: url('img/aditivos.jpg'); background-size: cover; background-position: center;"></div>
                    
                    <!-- Capa oscura para mejorar legibilidad -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 category-overlay"></div>
                    
                    <!-- Contenido del panel -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white text-center p-4 category-content">
                        <div>
                            <h2 class="category-title">Aditivos</h2>
                            <p class="category-description">Descubre nuestros aditivos para mejorar el rendimiento de tu motor</p>
                            <a href="aditivos.php" class="category-btn">
                                <i class="fas fa-flask category-icon"></i>
                                Ver Productos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid, tm-container-content -->

    
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });

        // Verificar que los enlaces funcionen
        document.addEventListener('DOMContentLoaded', function() {
            const categoryBtns = document.querySelectorAll('.category-btn');
            
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Agregar efecto visual al hacer clic
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                    
                    // Verificar si el archivo existe (opcional)
                    console.log('Navegando a:', this.href);
                });
            });
        });
    </script>

    <?php include "includes/footer.php" ?>
</body>
</html>