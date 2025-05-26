<?php

namespace App\Daos;

use App\Clases\Database;

class CarritoDao
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function agregarCarrito($idUsuario, $idArticulo, $cantidad)
    {
        try {
            $sql = "INSERT INTO TBL_CARRITO (ID_ARTICULO, ID_USUARIO, CANTIDAD)
                VALUES (:ID_ART, :ID_USER, :CANTIDAD)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':ID_ART', $idArticulo);
            $stmt->bindParam(':ID_USER', $idUsuario);
            $stmt->bindParam(':CANTIDAD', $cantidad);

            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            echo "Error al agregar al articulo: " . $e->getMessage();
            return false;
        }
    }

    public function mostrarCarrito($idUsuario)
    {
        try {
            $sql = "SELECT A.ID, B.IMAGEN ,B.NOMBRE, B.SKU, C.NOMBRE AS MARCA,B.ID AS ID_ARTICULO, B.PRECIO, A.CANTIDAD
                    FROM TBL_CARRITO AS A 
                    LEFT JOIN TBL_ARTICULOS AS B 
                    ON A.ID_ARTICULO = B.ID
                    LEFT JOIN TBL_MARCAS AS C
                    ON B.MARCA = C.ID
                    WHERE A.ID_USUARIO = :IDUSER";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSER', $idUsuario);
            $stmt->execute();
            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }

    public function agregarCantidad($idCard)
    {
        try {
            $sql = "UPDATE TBL_CARRITO SET CANTIDAD = CANTIDAD + 1 WHERE ID = :IDCARD";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDCARD', $idCard, \PDO::PARAM_INT);

            $stmt->execute();
            return true; // Devolver true si la actualización fue exitosa
        } catch (\PDOException $e) {
            echo "Error al agregar al articulo: " . $e->getMessage();
            return false;
        }
    }

    public function quitarCantidad($idCard)
    {
        try {
            // Primero, actualiza la cantidad y establece en 0 si es menor
            $sql = "UPDATE TBL_CARRITO SET CANTIDAD = CASE 
                        WHEN CANTIDAD > 0 THEN CANTIDAD - 1 
                        ELSE 0 
                    END 
                    WHERE ID = :IDCARD";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDCARD', $idCard, \PDO::PARAM_INT);
            $stmt->execute();

            // Luego, verifica si la cantidad es 0 y elimina el artículo del carrito
            $sql = "DELETE FROM TBL_CARRITO WHERE ID = :IDCARD AND CANTIDAD = 0";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDCARD', $idCard, \PDO::PARAM_INT);
            $stmt->execute();

            return true; // Devolver true si la operación fue exitosa
        } catch (\PDOException $e) {
            echo "Error al actualizar la cantidad del artículo: " . $e->getMessage();
            return false;
        }
    }

    public function agregaArticuloExistente($idArticulo)
    {
        try {
            // Primero, verifica si el artículo ya está en el carrito del usuario
            $sql = "SELECT COUNT(*) FROM TBL_CARRITO WHERE ID_ARTICULO = :ID_ART AND ID_USUARIO = :ID_USER";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ID_ART', $idArticulo, \PDO::PARAM_INT);
            $stmt->bindParam(':ID_USER', $_SESSION['ID'], \PDO::PARAM_INT);
            $stmt->execute();

            // Obtén el número de filas que coinciden
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                // Si el artículo ya existe, actualiza la cantidad
                $sql = "UPDATE TBL_CARRITO SET CANTIDAD = CANTIDAD + 1 WHERE ID_ARTICULO = :ID_ART AND ID_USUARIO = :ID_USER";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':ID_ART', $idArticulo, \PDO::PARAM_INT);
                $stmt->bindParam(':ID_USER', $_SESSION['ID'], \PDO::PARAM_INT);
                $stmt->execute();
                return true; // Devolver true si la actualización fue exitosa
            } else {
                // Manejar el caso donde el artículo no existe en el carrito
                echo "El artículo no está en el carrito.";
                return false;
            }
        } catch (\PDOException $e) {
            echo "Error al agregar al artículo: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($idCard)
    {
        try {
            $sql = "DELETE FROM TBL_CARRITO WHERE ID = :IDCARD ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDCARD', $idCard, \PDO::PARAM_INT);
            $stmt->execute();
            return true; // Devolver true si la actualización fue exitosa
        } catch (\PDOException $e) {
            echo "Error al agregar al articulo: " . $e->getMessage();
            return false;
        }
    }

    public function calculoPrecio($idUsuario)
    {
        try {
            $sql = "SELECT SUM(B.PRECIO * A.CANTIDAD) AS SUBTOTAL
                    FROM TBL_CARRITO AS A
                    JOIN TBL_ARTICULOS AS B
                    ON A.ID_ARTICULO = B.ID
                    WHERE ID_USUARIO = :IDUSER";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSER', $idUsuario, \PDO::PARAM_INT);
            $stmt->execute();

            // Obtén el resultado en un array asociativo
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $resultado['SUBTOTAL'];
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }
}
