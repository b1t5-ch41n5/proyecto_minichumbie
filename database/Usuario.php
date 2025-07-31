<?php

    // Clase para realizar operaciones relacionadas con usuarios en la base de datos

    class UsuarioDriver  {


        public $Conexion;
        function  __construct($Conexion) {
            // Constructor logic here
            $this->Conexion = $Conexion;

        }

        // Editar información de un usuario
        function EdicionInformacion($id,$Columna , $Dato){

            try {

                $query = "UPDATE credenciales SET $Columna = :dato WHERE id_user = :id";
                $Stmt = $this->Conexion->prepare($query);
                $Stmt->bindValue(':id', $id);
                $Stmt->bindValue(':dato', $Dato);
                $Stmt->execute();
                if ($Stmt->rowCount() > 0) {
                    return true;
                }
            } catch (PDOException $e) {
                    echo "Error al actualizar la información del usuario: " . $e->getMessage();
                    return false;
            }

        }

        // Consultar usuario por nombre de usuario y contraseña
        function ConsultarUsaurio($Usuario , $Contrasena) {
            try {
                $query = "SELECT * FROM credenciales WHERE nombre_de_usuario = :usuario AND hash_de_contrasena = :contrasena";
                $Stmt = $this->Conexion->prepare($query);
                $Stmt->bindValue(':usuario', $Usuario);
                $Stmt->bindValue(':contrasena', $Contrasena);
                $Stmt->execute();
                if ($Stmt->rowCount() > 0) {
                    return $Stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo "Error Usuario invalido : " . $e->getMessage();
                return false;
            }
        }
        

    }
?>