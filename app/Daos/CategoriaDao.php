<?php

namespace App\Daos;

use App\Clases\Database;

class CategoriaDao
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function index()
    {
        try {
            $sql = "SELECT ID, NOMBRE FROM TBL_CATEGORIAS ORDER BY ID DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }
}
