<?php
    include 'sesion.php';
    include '../database/Coneccion.php';
    include '../database/ArticuloSql.php';

    $Productos = new ItemOperations($Conexion);

    $InfoItem = null;
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['login'])) {
        $Id = $_GET['id'];
        $Info = $Productos->DatosAdtivo($Id);
        if ($Info && $Info->rowCount() > 0) {
            $InfoItem = $Info->fetch(PDO::FETCH_ASSOC);
            $IdFabricante = $InfoItem['id_fabricante'];
            $Ventas = $Productos->VentaAditivo($Id);
            $Ganancias = $Productos->VentaAditivo($Id);
        }
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            $Id = $_POST['id'];
            $Info = $Productos->DatosAdtivo($Id);
            if ($Info && $Info->rowCount() > 0) {
                $InfoItem = $Info->fetch(PDO::FETCH_ASSOC);
                $IdFabricante = $InfoItem['id_fabricante'];
                $Disponibles = $InfoItem['disponibles'];
                $Precio = $InfoItem['precio'];
            }

            if( $_POST['disponibles'] !== $Disponibles ){
                $succes = $Productos->CambiarValoresAditivo($_POST['disponibles'], 'disponibles', $Id);
                if (!$succes) {
                    echo "<script>alert('Error al actualizar la cantidad disponible.');</script>";
                } 
            }

            if ($_POST['precio'] !== $Precio) {
                $succes = $Productos->CambiarValoresAditivo($_POST['precio'], 'precio', $Id);
                if (!$succes) {
                    echo "<script>alert('Error al actualizar el precio.');</script>";
                } 
            }

            if (intval($_POST['vendidos']) !== 0) {
                // Corregido: el bucle ahora ejecuta exactamente la cantidad de ventas indicada
                for($i=0 ; $i < intval($_POST['vendidos']) ;  $i++) {    
                    $VentaEcha = $Productos->RealizarVentaAdtivo($Id, intval($_POST['precio']));
                }
                // Actualizar disponibles solo una vez después de registrar todas las ventas
                $Disponibles = $Productos->CambiarValoresAditivo(intval($_POST['disponibles']) - intval($_POST['vendidos']), 'disponibles', $Id);
                if (!$VentaEcha && !$Disponibles) {
                    echo "<script>alert('Error al actualizar la cantidad vendida.');</script>";
                } 
            }

            $Info = $Productos->DatosAdtivo($Id);
            $InfoItem = $Info->fetch(PDO::FETCH_ASSOC);
            $Ventas = $Productos->VentaAditivo($Id);
            $Ganancias = $Productos->VentaAditivo($Id);
            header("Location: itemdetail.php?id=$Id");
            exit();
        }else {
            header('Location: ../aditivos.php');
            exit();
        }

    }else {
        header('Location: ../aditivos.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Producto - MINICHUMBIE</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery para manipulación del DOM -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        
        .main-content {
            flex: 1;
        }
        
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .product-card:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .product-img-container {
            height: 300px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        
        .editable {
            cursor: pointer;
            border-bottom: 1px dashed #dc3545;
            padding: 2px;
        }
        
        .editable:hover {
            background-color: #f8f9fa;
        }
        
        .inventory-controls {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .inventory-controls button {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
        }
        
        .inventory-count {
            min-width: 40px;
            text-align: center;
        }
        
        .sales-info {
            font-size: 0.85rem;
            margin-top: 10px;
        }
        
        .save-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        
        .form-control-editable {
            border: none;
            border-bottom: 1px dashed #dc3545;
            background-color: transparent;
            color: inherit;
            font-weight: inherit;
        }
        
        .form-control-editable:focus {
            outline: none;
            box-shadow: none;
            border-bottom: 1px solid #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbarmin.php'; ?>

    <!-- Contenido principal -->
    <div class="main-content bg-dark text-white">
        <div class="container py-4">
            <!-- Encabezado del detalle -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="display-5 text-danger">Detalle del Producto</h1>
                    <p class="lead">Información detallada y gestión de inventario</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2 mb-4">
                    <a  class="btn btn-outline-danger" href="catalogo?id=<?= $IdFabricante ?>"  id="decreaseStock"> back to the list</a>
                </div>
            </div>
            <!-- Detalle del producto -->
            <div class="row">
                <div class="col-12">
                    <?php if ($InfoItem): ?>
                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <input type="hidden" name="id" value="<?= $Id ?>">

                        <div class="card product-card shadow-lg border-0">
                            <div class="row g-0">
                                <!-- Imagen del producto -->
                                <div class="col-md-5">
                                    <div class="product-img-container h-100 bg-light">
                                        <img src="<?= '../img/Aditivos/' . $InfoItem['nombre'] . '/productos/' . $InfoItem['ubicacion'] ?>" class="product-img rounded" alt="<?= htmlspecialchars($InfoItem['referencia']) ?>">
                                    </div>
                                </div>
                                <!-- Información del producto -->
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <!-- Nombre y descripción -->
                                        <div class="mb-3">
                                            <input type="text" name="referencia" class="form-control form-control-lg fw-bold mb-2 text-center" id="productName" value="<?= htmlspecialchars($InfoItem['referencia']) ?>">
                                        </div>
                                        <!-- Precio unitario -->
                                        <div class="mb-3">
                                            <label class="form-label">Precio unitario:</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark fw-bold">$</span>
                                                <input type="number" name="precio" class="form-control" id="unitPrice" value="<?= isset($InfoItem['precio']) ? $InfoItem['precio'] : '' ?>">
                                            </div>
                                        </div>
                                        <!-- Gestión de inventario -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Disponibles:</label>
                                                <div class="inventory-controls">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" id="decreaseStockBtn">-</button>
                                                    <input type="number" name="disponibles" class="form-control text-center mx-2" id="stockCount" value="<?= isset($InfoItem['disponibles']) ? $InfoItem['disponibles'] : 0 ?>" min="0" style="width: 70px;" oninput="validarDisponibles()">
                                                    <button type="button" class="btn btn-sm btn-outline-success" id="increaseStockBtn">+</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="inventory-controls text-center">
                                                    <p>
                                                        Vendidos:<br>
                                                        <span class="fw-bold fs-4">
                                                            <?php 
                                                                $totalVentas = 0;
                                                                if ($Ventas && $Ventas->rowCount() > 0) {
                                                                    foreach ($Ventas as $v) {
                                                                        $totalVentas++;
                                                                    }
                                                                    echo $totalVentas;
                                                                } else {
                                                                    echo 0;
                                                                }
                                                            ?> 
                                                        </span>
                                                    </p>
                                                    
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="inventory-controls text-center">
                                                    <p>
                                                        Ganancia total de este mes: <br>
                                                        <span class="fw-bold fs-4">
                                                        <?php 
                                                            $Total = 0;
                                                            if ($Ganancias && $Ganancias->rowCount() > 0) {
                                                                while($Ganancia = $Ganancias->fetch(PDO::FETCH_ASSOC)) {
                                                                    $Total += $Ganancia['precio'] ;
                                                                }
                                                                echo $Total;
                                                            }
                                                                        
                                                        ?> 
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Vender:</label>
                                                <div class="inventory-controls">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" id="decreaseSold">-</button>
                                                    <input type="number" name="vendidos" class="form-control text-center mx-2" id="soldCount" value="0"
                                                    min="0" max="<?= isset($InfoItem['disponibles']) ? $InfoItem['disponibles'] : 0 ?>" style="width: 70px;" oninput="validarVendidos()">
                                                    <button type="button" class="btn btn-sm btn-outline-success" id="increaseSold">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Información de ventas -->
                                        <div class="row mt-3">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ganancia total:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-warning text-dark fw-bold">$</span>
                                                    <input type="text" class="form-control" id="totalProfit" value="0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Última actualización:</label>
                                                <div id="lastUpdate" class="form-control bg-dark text-white">
                                                    Hoy <?= date('H:i') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Información adicional -->
                                        <div class="mt-3">
                                            <h5 class="fw-bold">Especificaciones:</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label class="form-label">Marca:</label>
                                                        <input type="text" name="marca" class="form-control" id="brand" value="<?= isset($InfoItem['nombre']) ? htmlspecialchars($InfoItem['nombre']) : '' ?>">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="form-label">Categoría:</label>
                                                        <input type="text" name="categoria" class="form-control" id="category" value="<?= isset($InfoItem['id_categoria']) ? htmlspecialchars($InfoItem['id_categoria']) : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label class="form-label">Código:</label>
                                                        <input type="text" name="codigo" class="form-control" id="productCode" value="<?= isset($InfoItem['id_aditivo']) ? htmlspecialchars($InfoItem['id_aditivo']) : '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                        <div class="mb-3">
                            <label class="form-label">Historial de ventas:</label>
                            <div class="row">
                                <?php 
                                $VentasHistorial = $Productos->VentaAditivo($Id);
                                $contador = 0;
                                if ($VentasHistorial && $VentasHistorial->rowCount() > 0): ?>
                                    <?php while ($Venta = $VentasHistorial->fetch(PDO::FETCH_ASSOC)): ?>
                                        <div class="container mb-2">
                                            <div class="row">
                                                <div class="card border-0">
                                                    <div class="card-body">
                                                        <p class="fw-bold">
                                                            Venta #<?= ++$contador ?> <br> Fecha: <?= date('d/M/Y, h:i:s', strtotime($Venta['fecha_de_la_venta']))?> por <?= $Venta['precio'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="alert alert-warning text-center">No se encontraron ventas.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-danger btn-lg rounded save-button" name="submit">
                                                <i class="fas fa-save"></i> Guardar cambios
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="alert alert-danger text-center">No se encontró información del producto.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Footer -->
    <?php include 'footer.php'; ?>
    
    <!-- JavaScript para la funcionalidad -->
    <script>
        $(document).ready(function() {
            function updateTotalProfit() {
                const unitPrice = parseFloat($('#unitPrice').val());
                const soldCount = parseInt($('#soldCount').val());
                const totalProfit = unitPrice * soldCount;
                $('#totalProfit').val(totalProfit.toFixed(0));
            }

            function validarDisponibles() {
                let stock = parseInt($('#stockCount').val());
                if (isNaN(stock) || stock < 0) {
                    $('#stockCount').val(0);
                }
            }

            function validarVendidos() {
                let vendidos = parseInt($('#soldCount').val());
                let disponibles = parseInt($('#stockCount').val());
                if (isNaN(vendidos) || vendidos < 0) {
                    $('#soldCount').val(0);
                } else if (vendidos > disponibles) {
                    $('#soldCount').val(disponibles);
                }
                updateTotalProfit();
            }

            // Eventos para los botones de control de inventario
            $('#increaseStockBtn').click(function() {
                let currentStock = parseInt($('#stockCount').val());
                if (isNaN(currentStock)) currentStock = 0;
                $('#stockCount').val(currentStock + 1);
                validarDisponibles();
                validarVendidos();
            });

            $('#decreaseStockBtn').click(function() {
                let currentStock = parseInt($('#stockCount').val());
                if (isNaN(currentStock)) currentStock = 0;
                if (currentStock > 0) {
                    $('#stockCount').val(currentStock - 1);
                }
                validarDisponibles();
                validarVendidos();
            });

            $('#increaseSold').click(function() {
                let currentSold = parseInt($('#soldCount').val());
                let disponibles = parseInt($('#stockCount').val());
                if (isNaN(currentSold)) currentSold = 0;
                if (currentSold < disponibles) {
                    $('#soldCount').val(currentSold + 1);
                }
                validarVendidos();
            });

            $('#decreaseSold').click(function() {
                let currentSold = parseInt($('#soldCount').val());
                if (isNaN(currentSold)) currentSold = 0;
                if (currentSold > 0) {
                    $('#soldCount').val(currentSold - 1);
                }
                validarVendidos();
            });

            // Actualizar ganancia cuando cambia el precio unitario
            $('#unitPrice').on('input', function() {
                updateTotalProfit();
            });

            // Validar disponibles y vendidos cuando cambian
            $('#stockCount').on('input', function() {
                validarDisponibles();
                validarVendidos();
            });
            $('#soldCount').on('input', function() {
                validarVendidos();
            });

            // Guardar cambios
            $('#saveChanges').click(function() {
                const now = new Date();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const timeString = `Hoy ${hours}:${minutes}`;
                $('#lastUpdate').text(timeString);
                alert('Cambios guardados correctamente');
            });
        });
        // Hacer las funciones accesibles globalmente para oninput
        window.validarDisponibles = function() {
            let stock = parseInt($('#stockCount').val());
            if (isNaN(stock) || stock < 0) {
                $('#stockCount').val(0);
            }
        };
        window.validarVendidos = function() {
            let vendidos = parseInt($('#soldCount').val());
            let disponibles = parseInt($('#stockCount').val());
            if (isNaN(vendidos) || vendidos < 0) {
                $('#soldCount').val(0);
            } else if (vendidos > disponibles) {
                $('#soldCount').val(disponibles);
            }
            const unitPrice = parseFloat($('#unitPrice').val());
            const soldCount = parseInt($('#soldCount').val());
            const totalProfit = unitPrice * soldCount;
            $('#totalProfit').val(totalProfit.toFixed(0));
        };
    </script>
</body>
</html>