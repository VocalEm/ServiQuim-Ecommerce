<?php

namespace App\Daos;

use App\Clases\Database;

class ArticuloDao
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($articulo)
    {
        try {
            $sql = "INSERT INTO TBL_USUARIOS (CORREO, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, PASSWORD, TELEFONO, ISADMIN)
                VALUES (:CORREO, :NOMBRE, :APELLIDO_PATERNO, :APELLIDO_MATERNO, :PASSWORD, :TELEFONO, 0)";
            $stmt = $this->db->prepare($sql);

            $correo = $articulo->getCorreo();
            $nombre = $articulo->getNombre();
            $apellidoPaterno = $articulo->getApellidoPaterno();
            $apellidoMaterno = $articulo->getApellidoMaterno();
            $password = $articulo->getPassword();
            $telefono = $articulo->getTelefono();

            $stmt->bindParam(':CORREO', $correo);
            $stmt->bindParam(':NOMBRE', $nombre);
            $stmt->bindParam(':APELLIDO_PATERNO', $apellidoPaterno);
            $stmt->bindParam(':APELLIDO_MATERNO', $apellidoMaterno);
            $stmt->bindParam(':PASSWORD', $password);
            $stmt->bindParam(':TELEFONO', $telefono);

            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            echo "Error al crear usuario: " . $e->getMessage();
            return false;
        }
    }

    public function index()
    {
        try {
            $sql = "SELECT ID, SKU, NOMBRE, DESCRIPCION, CATEGORIA, MARCA, IMAGEN, PRECIO FROM TBL_ARTICULOS WHERE IS_ACTIVO = TRUE;";
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

    public function indexByCategoria($idCategoria)
    {
        try {
            $sql = "SELECT ID, SKU, NOMBRE, DESCRIPCION, CATEGORIA, MARCA, IMAGEN, PRECIO FROM TBL_ARTICULOS WHERE IS_ACTIVO = TRUE AND CATEGORIA = :IDCATEGORIA;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDCATEGORIA', $idCategoria);
            $stmt->execute();

            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }

    public function byId($id)
    {
        try {
            $sql = "SELECT A.ID, A.SKU, A.NOMBRE, A.DESCRIPCION, A.CATEGORIA, A.MARCA, A.IMAGEN, A.PRECIO,
                    B.NOMBRE AS MARCA_NOMBRE, C.NOMBRE AS CATEGORIA_NOMBRE
                    FROM TBL_ARTICULOS
                    AS A LEFT JOIN 
                    TBL_MARCAS AS B ON A.MARCA = B.ID 
                    JOIN TBL_CATEGORIAS AS C
                    ON A.CATEGORIA = C.ID 
                    WHERE IS_ACTIVO = TRUE AND A.ID = :ID;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ID', $id);
            $stmt->execute();
            // Obtén todos los resultados en un array asociativo
            $resultados = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }
}
