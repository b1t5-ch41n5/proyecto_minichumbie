<?php
    // =============================
    // Protección de sesión y carga de dependencias
    // =============================
    include 'sesion.php'; // Inicia la sesión PHP
    include '../database/Coneccion.php'; // Conexión a la base de datos
    include '../database/ArticuloSql.php'; // Operaciones sobre los artículos/productos
    
    // =============================
    // Lógica de acceso y obtención de productos
    // =============================
    // Solo permite acceso si la petición es GET y el usuario está autenticado
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['login'])):
        $productos = new ItemOperations($Conexion); // Instancia para operaciones de productos
        if (!isset($_GET['id'])): // Si no se especifica el id del fabricante, redirige al home
            header("Location: home.php");
            exit();
        else:
            $id = $_GET['id']; // Obtiene el id del fabricante desde la URL
            $Items = $productos->Aditivos($id); // Consulta los productos asociados a ese fabricante
            // Si no hay productos o la consulta falla, redirige a la sección de aditivos
            if (!$Items && !$Items->rowCount() > 0):
                header("Location: aditivos.php");
                exit();
            endif;
        endif;
    else:
        // Si no hay sesión o la petición no es GET, redirige al login
        header("Location: ../login.php");
        exit();
    endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <?php include 'navbarmin.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .catalogo-section {
            padding: 60px 0 30px 0;
        }
        .card-producto {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-producto:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 16px 40px rgba(220,53,69,0.18);
            border-color: #ffd700;
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
            background: #222;
        }
        .btn-detalle {
            background: linear-gradient(45deg, #dc3545, #ff6b35);
            border: none;
            border-radius: 50px;
            padding: 10px 28px;
            font-weight: bold;
            color: #fff;
            transition: background 0.3s, color 0.3s;
        }
        .btn-detalle:hover {
            background: linear-gradient(45deg, #ffd700, #ff6b35);
            color: #000;
        }
    </style>
</head>
<body>
    <!-- =============================
         Sección principal del catálogo de productos
    ============================== -->
    <div class="container catalogo-section">
        <div class="row mb-4">
            <div class="col-6 mb-4">
                <!-- Botón para regresar a la sección de proveedores -->
                <a  class="btn btn-outline-danger" href="../aditivos.php"  id="decreaseStock"> < Volver a proveedores</a>
            </div>

            <div class="col-12 text-center">
                <!-- Título y subtítulo del catálogo -->
                <h1 class="display-5 fw-bold text-warning mb-2">Catálogo de Productos</h1>
                <p class="lead text-white-50">Explora nuestra selección de lubricantes premium</p>
            </div>
        </div>
        <div class="row justify-content-center g-3 px-3">
        <?php if (isset($Items) && $Items): ?>
            <?php while($producto = $Items->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-3">
                    <div class="card card-producto h-100">
                        <?php
                            // =============================
                            // Construcción de la ruta de la imagen del producto
                            // =============================
                            // Si tienes un campo específico para la imagen, ajústalo aquí
                            $img = '../img/Aditivos/' . $producto['nombre'] . '/productos/' . $producto['ubicacion']; 
                        ?>
                        <img src="<?= $img ?>" class="card-img-top" alt="Producto">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <!-- Nombre/referencia del producto -->
                            <h5 class="card-title mb-2"><?= htmlspecialchars($producto['referencia']) ?></h5>
                            <!-- Cantidad disponible -->
                            <p class="card-text mb-2">Disponibles: <span class="fw-bold text-warning"><?= isset($producto['disponibles']) ? $producto['disponibles'] : 'N/A' ?></span></p>
                            <!-- Botón para ver el detalle del producto -->
                            <a href="itemdetail.php?id=<?= isset($producto['id_aditivo']) ? $producto['id_aditivo'] : '' ?>" class="btn btn-detalle mt-auto">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- Mensaje si no hay productos para mostrar -->
            <div class="col-12 text-center text-danger">No hay productos para mostrar.</div>
        <?php endif; ?>
        </div>
    </div>
    <!-- =============================
         Footer reutilizable
    ============================== -->
    <?php include "footer.php"; ?>
</body>
</html>