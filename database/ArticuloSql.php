<?php
    // Clase para realizar operaciones en la base de datos
    class ItemOperations {

        public $Tabla ; 
        public $Columna ;
        public $ConnectionObject;
        public $Id ; 
        
        public function __construct($ConnectionObject) {
            $this->ConnectionObject = $ConnectionObject;
        }

        // Actualizar la cantidad disponible de un producto
        public function ActualizarCantidad($Tabla, $NuevaCantidad, $IdProducto  , $Precio = null) {
            try{
                $this->Tabla = $Tabla;
                if ($Precio !== null) {
                    $sql = "UPDATE $this->Tabla SET disponible = '$NuevaCantidad', Precio = '$Precio' WHERE Id = '$IdProducto'";
                    $Stmtm = $this->ConnectionObject->prepare($sql);
                    $Stmtm->bindParam(':NuevaCantidad', $NuevaCantidad, PDO::PARAM_INT);

                } else {
                    $sql = "UPDATE $this->Tabla SET disponible = '$NuevaCantidad' WHERE Id = '$IdProducto'";
                    $Stmtm = $this->ConnectionObject->prepare($sql);
                    $Stmtm->bindParam(':NuevaCantidad', $NuevaCantidad, PDO::PARAM_INT);
                    $Stmtm->bindParam(':IdProducto', $IdProducto, PDO::PARAM_INT);
                    $Stmtm->execute();
                    return true;
                }
            } catch (PDOException $e) {
                echo "Error al preparar la consulta: " . $e->getMessage();
                return false;
            }
            
            
        }

        // Consultar productos de una categoría específica
        public Function Aditivos($Id) {
            try {
                $Sql = "SELECT * FROM fabricante_aditivos as F 
                INNER JOIN aditivos_item  as a ON f.id_fab = a.id_fabricante 
                INNER JOIN aditivos_imagenes as ad on ad.id_item = a.id_aditivo where f.id_fab = :id";
                $Stmtm = $this->ConnectionObject->prepare($Sql);
                $Stmtm->bindParam(':id', $Id, PDO::PARAM_INT); ;
                $Stmtm->execute();
                return $Stmtm ; 
            } catch (PDOException $e) {
                echo "Error al preparar la consulta: " . $e->getMessage();
                return false;

            }
        }

        // Consultar productos de una categoría específica
        public Function VentaAditivo($Id) {
            
            $this->Id = $Id; 
            try {
                $Sql = "SELECT * FROM ventaAditivos AS v WHERE v.id_item = :id";
                $Stmtm = $this->ConnectionObject->prepare($Sql);
                $Stmtm->bindParam(':id', $this->Id) ;
                $Stmtm->execute();
                return $Stmtm ; 
            } catch (PDOException $e) {
                echo "Error al preparar la consulta: " . $e->getMessage();
                return false;

            }

        }
        // Realizar una venta de un aditivo
        public function RealizarVentaAdtivo($Id , $Precio){
            try{

                $Sql = "INSERT INTO ventaaditivos (id_categoria , id_item, precio ,  fecha_de_la_venta) VALUES (2, :id, :precio, DEFAULT)";
                $Stmtm = $this->ConnectionObject->prepare($Sql);
                $Stmtm->bindParam(':precio', $Precio, PDO::PARAM_INT);
                $Stmtm->bindParam(':id', $Id, PDO::PARAM_INT);
                $Stmtm->execute();
                return true;
            }catch (PDOException $e) {  
                echo "Error al preparar la consulta: " . $e->getMessage();
                return false;

            }
        }

        // Consultar los detalles de un aditivo específico
        public Function DatosAdtivo($IdProducto) {
            try {
                $sql = "SELECT *  from fabricante_aditivos as f 
                INNER JOIN  aditivos_item as a ON a.id_fabricante  = f.id_fab 
                INNER JOIN aditivos_imagenes as ad ON ad.id_item = a.id_aditivo WHERE a.id_aditivo = :id";
                $Stmtm = $this->ConnectionObject->prepare($sql);
                $Stmtm->bindParam(':id', $IdProducto, PDO::PARAM_INT);
                $Stmtm->execute();
                
                if ($Stmtm->rowCount() > 0) {
                    return $Stmtm;
                } else {
                    return null; // No se encontraron resultados
                }
            } catch (PDOException $e) {
                echo "Error al consultar los datos: " . $e->getMessage();
                return false;
            }
        }

        // Cambiar valores de un aditivo específico
        public Function CambiarValoresAditivo($Valor,$Columna,$IdProducto) {
            $this->Columna = $Columna;
            try {
                $sql = "UPDATE aditivos_item SET $this->Columna = :Valor WHERE id_aditivo = :id";
                $Stmtm = $this->ConnectionObject->prepare($sql);
                $Stmtm->bindParam(':Valor', $Valor, PDO::PARAM_INT);
                $Stmtm->bindParam(':id', $IdProducto, PDO::PARAM_INT);
                $Stmtm->execute();
                return true; // Actualización exitosa
            } catch (PDOException $e) {
                    echo "Error al preparar la consulta: " . $e->getMessage();
                    return false;
            }
        }
        
    }

?>