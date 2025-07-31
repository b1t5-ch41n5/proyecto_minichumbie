<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catalog-Z Bootstrap 5.0 HTML Template</title>
         <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <style>
        /* =============================
           Estilos personalizados para navbar de estación de combustible
           Incluye gradientes, animaciones y efectos visuales
        ============================== */
        .fuel-navbar {
            /* Fondo con gradiente y sombra para dar profundidad */
            background: linear-gradient(135deg, #2c1810 0%, #3d2317 50%, #4a2a1a 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border-bottom: 3px solid #dc3545;
            position: relative;
            overflow: hidden;
        }

        .fuel-navbar::before {
            /* Línea animada superior simulando flujo de combustible */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #ffd700, #ff6b35, #dc3545, #ffd700);
            animation: fuel-flow 3s linear infinite;
        }

        @keyframes fuel-flow {
            /* Animación de la línea superior */
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .fuel-brand {
            /* Marca y logo de la estación */
            font-weight: bold;
            font-size: 1.3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fuel-brand:hover {
            /* Efecto hover en la marca */
            transform: scale(1.05);
            color: #ffd700 !important;
        }

        .fuel-icon {
            /* Icono circular animado */
            background: linear-gradient(45deg, #dc3545, #ff6b35);
            padding: 8px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.4);
            animation: pulse-fuel 2s infinite;
        }

        @keyframes pulse-fuel {
            /* Animación de pulso para el icono */
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .fuel-nav-link {
            /* Estilos para los enlaces del navbar */
            position: relative;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 5px;
            padding: 10px 15px !important;
        }

        .fuel-nav-link:hover {
            /* Efecto hover en los enlaces */
            background: rgba(220, 53, 69, 0.1);
            transform: translateY(-2px);
            color: #ffd700 !important;
        }

        .fuel-nav-link::after {
            /* Línea animada debajo del enlace al hacer hover */
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #ffd700, #dc3545);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .fuel-nav-link:hover::after {
            width: 80%;
        }

        .logout-btn {
            /* Botón de cerrar sesión con gradiente y sombra */
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            /* Efecto de brillo al hacer hover en el botón */
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .logout-btn:hover::before {
            left: 100%;
        }

        .logout-btn:hover {
            /* Efecto hover en el botón de logout */
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            background: linear-gradient(45deg, #e74c3c, #dc3545);
        }

        .logout-btn .nav-link {
            /* Estilo del texto e icono dentro del botón de logout */
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .navbar-toggler {
            /* Botón hamburguesa para responsive */
            border: 2px solid #dc3545;
            border-radius: 8px;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: rgba(220, 53, 69, 0.1);
            transform: scale(1.05);
        }

        .navbar-toggler-icon {
            /* Icono hamburguesa personalizado */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28220, 53, 69, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Efectos adicionales para dar sensación de combustible */
        .fuel-effect {
            /* Gradientes decorativos en el fondo del navbar */
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(220, 53, 69, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        /* =============================
           Ajustes responsivos para dispositivos móviles
        ============================== */
        @media (max-width: 768px) {
            .fuel-brand {
                font-size: 1.1rem;
            }
            .fuel-nav-link {
                margin: 5px 0;
            }
        }
        </style>
    <nav class="navbar navbar-expand-lg py-3 fuel-navbar">
        <div class="fuel-effect"></div>
        <div class="container-fluid">
            <a class="navbar-brand text-danger fuel-brand" href="/test/minichumbie/home.php">
                <div class="fuel-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-fuel-pump-fill" viewBox="0 0 16 16">
                        <path d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1q.846-.002 1.412.336c.383.228.634.551.794.907.295.655.294 1.465.294 2.081V7.5a.5.5 0 0 1-.5.5H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm2.5 0a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5z"/>
                    </svg>
                </div>
                <span>COMPLEMENTARIOS MINICHUMBIE</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fuel-nav-link active text-danger" aria-current="page" href="includes/error.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-gear me-2" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                            </svg>
                            Editar Usuario
                        </a>
                    </li>
                    <li class="nav-item logout-btn">
                        <a class="nav-link d-flex align-items-center" href='/test/minichumbie/includes/logout.php'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 0-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>