<?php

namespace App\Daos;

use App\Clases\Database;

class DashboardDao
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function articuloMasVendido()
    {
        try {
            $sql = "SELECT ID_ARTICULO, COUNT(*) AS TOTAL_VENTAS 
                    FROM TBL_DETALLE_PEDIDO GROUP BY ID_ARTICULO ORDER BY TOTAL_VENTAS DESC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            //$stmt->bindParam(':IDCATEGORIA', $idCategoria);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetch(\PDO::FETCH_ASSOC);

            $sql2 = "SELECT ID, SKU, NOMBRE, DESCRIPCION, CATEGORIA, MARCA, IMAGEN, PRECIO, IS_ACTIVO
                    FROM TBL_ARTICULOS WHERE ID = :IDARTICULO";
            $stmt = $this->db->prepare($sql2);
            $stmt->bindParam(':IDARTICULO', $resultados['ID_ARTICULO']);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $articulo = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $articulo;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }

    public function articuloMasFavorito()
    {
        try {
            $sql = "SELECT ID_ARTICULO, COUNT(*) AS MAS_FAV
                    FROM TBL_FAVORITOS GROUP BY ID_ARTICULO ORDER BY MAS_FAV DESC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            //$stmt->bindParam(':IDCATEGORIA', $idCategoria);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetch(\PDO::FETCH_ASSOC);

            $sql2 = "SELECT ID, SKU, NOMBRE, DESCRIPCION, CATEGORIA, MARCA, IMAGEN, PRECIO, IS_ACTIVO
                    FROM TBL_ARTICULOS WHERE ID = :IDARTICULO";
            $stmt = $this->db->prepare($sql2);
            $stmt->bindParam(':IDARTICULO', $resultados['ID_ARTICULO']);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $articulo = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $articulo;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }

    public function articuloMenosFavorito()
    {
        try {
            $sql = "SELECT ID_ARTICULO, COUNT(*) AS TOTAL_VENTAS 
                    FROM TBL_DETALLE_PEDIDO GROUP BY ID_ARTICULO ORDER BY TOTAL_VENTAS ASC LIMIT 1";
            $stmt = $this->db->prepare($sql);
            //$stmt->bindParam(':IDCATEGORIA', $idCategoria);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetch(\PDO::FETCH_ASSOC);

            $sql2 = "SELECT ID, SKU, NOMBRE, DESCRIPCION, CATEGORIA, MARCA, IMAGEN, PRECIO, IS_ACTIVO
                    FROM TBL_ARTICULOS WHERE ID = :IDARTICULO";
            $stmt = $this->db->prepare($sql2);
            $stmt->bindParam(':IDARTICULO', $resultados['ID_ARTICULO']);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $articulo = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $articulo;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }
}
