<?php

namespace App\Daos;

use App\Clases\Database;

class UsuarioDao
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($usuario)
    {
        try {
            $sql = "INSERT INTO TBL_USUARIOS (CORREO, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, PASSWORD, TELEFONO, ISADMIN, FECHA_REGISTRO)
                VALUES (:CORREO, :NOMBRE, :APELLIDO_PATERNO, :APELLIDO_MATERNO, :PASSWORD, :TELEFONO, 0, CURDATE())";
            $stmt = $this->db->prepare($sql);

            $correo = $usuario->getCorreo();
            $nombre = $usuario->getNombre();
            $apellidoPaterno = $usuario->getApellidoPaterno();
            $apellidoMaterno = $usuario->getApellidoMaterno();
            $password = $usuario->getPassword();
            $telefono = $usuario->getTelefono();

            \var_dump($usuario);

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

    public function login($usuario)
    {
        try {
            $sql = "SELECT ID FROM TBL_USUARIOS WHERE CORREO = :CORREO AND PASSWORD = :PASSWORD";
            $stmt = $this->db->prepare($sql);

            $correo = $usuario->getCorreo();
            $password = $usuario->getPassword();

            $stmt->bindParam(':CORREO', $correo);
            $stmt->bindParam(':PASSWORD', $password);

            $stmt->execute();

            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($user) {
                return $user['ID'];
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo "Error al crear usuario: " . $e->getMessage();
            return false;
        }
    }

    public function perfil($id)
    {
        try { // Validar que el ID sea un número entero positivo 
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException("ID no válido.");
            }
            $sql = "SELECT ID, CORREO, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, PASSWORD, TELEFONO, ISADMIN, FECHA_REGISTRO FROM TBL_USUARIOS WHERE ID = :ID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ID', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $user ? $user : false;
        } catch (\PDOException $e) {
            echo "Error al obtener el perfil del usuario: " . $e->getMessage();
            return false;
        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function agregarFavorito($idUser, $idArt)
    {
        try {
            $sql = "INSERT INTO TBL_FAVORITOS (ID_USUARIO, ID_ARTICULO)
                VALUES (:IDUSER, :IDART)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':IDUSER', $idUser);
            $stmt->bindParam(':IDART', $idArt);


            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            echo "Error al crear usuario: " . $e->getMessage();
            return false;
        }
    }

    public function showFavoritos($id)
    {
        try { // Validar que el ID sea un número entero positivo 
            $sql = "SELECT 
                    A.ID, 
                    A.SKU, 
                    A.NOMBRE, 
                    A.DESCRIPCION, 
                    A.CATEGORIA, 
                    A.MARCA, 
                    A.IMAGEN, 
                    A.PRECIO
                    FROM 
                        TBL_ARTICULOS AS A 
                    JOIN 
                        TBL_FAVORITOS AS B ON A.ID = B.ID_ARTICULO 
                    JOIN 
                        TBL_USUARIOS AS C ON B.ID_USUARIO = C.ID 
                    WHERE 
                        C.ID = :IDUSER;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSER', $id, \PDO::PARAM_INT);
            $stmt->execute();

            $favoritos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $favoritos;
        } catch (\PDOException $e) {
            echo "Error al obtener el perfil del usuario: " . $e->getMessage();
            return false;
        }
    }

    public function showFavoritosById($id, $idArt)
    {
        try { // Validar que el ID sea un número entero positivo 
            $sql = "SELECT 
                    A.ID, 
                    A.SKU, 
                    A.NOMBRE, 
                    A.DESCRIPCION, 
                    A.CATEGORIA, 
                    A.MARCA, 
                    A.IMAGEN, 
                    A.PRECIO
                    FROM 
                        TBL_ARTICULOS AS A 
                    JOIN 
                        TBL_FAVORITOS AS B ON A.ID = B.ID_ARTICULO 
                    JOIN 
                        TBL_USUARIOS AS C ON B.ID_USUARIO = C.ID 
                    WHERE 
                        C.ID = :IDUSER AND A.ID = :IDART;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSER', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':IDART', $idArt, \PDO::PARAM_INT);

            $stmt->execute();

            $favoritos = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $favoritos;
        } catch (\PDOException $e) {
            echo "Error al obtener el perfil del usuario: " . $e->getMessage();
            return false;
        }
    }

    public function EliminarFavorito($idUsuario, $idArticulo)
    {
        try {
            $sql = "DELETE FROM TBL_FAVORITOS WHERE ID_USUARIO = :IDUSUARIO AND ID_ARTICULO = :IDARTICULO";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSUARIO', $idUsuario, \PDO::PARAM_INT);
            $stmt->bindParam(':IDARTICULO', $idArticulo, \PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            echo "Error al crear detalle del pedido o eliminar items del carrito: " . $e->getMessage();
            return false;
        }
    }


    public function editarUsuario($usuario)
    {
        try {
            $nombre = $usuario->getNombre();
            $apellidoPaterno = $usuario->getApellidoPaterno();
            $apellidoMaterno = $usuario->getApellidoMaterno();
            $password = $usuario->getPassword();
            $telefono = $usuario->getTelefono();

            // Actualizar los datos del usuario sin verificación del correo
            $sql = "UPDATE TBL_USUARIOS SET NOMBRE = :NOMBREMOD, 
            APELLIDO_PATERNO = :APELLIDOPATERNO, APELLIDO_MATERNO = :APELLIDOMATERNO, 
            PASSWORD = :PASSMOD, TELEFONO = :TELMOD WHERE ID = :IDUSER";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':NOMBREMOD', $nombre);
            $stmt->bindParam(':APELLIDOPATERNO', $apellidoPaterno);
            $stmt->bindParam(':APELLIDOMATERNO', $apellidoMaterno);
            $stmt->bindParam(':PASSMOD', $password);
            $stmt->bindParam(':TELMOD', $telefono);
            $stmt->bindParam(':IDUSER', $_SESSION['ID']);

            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            echo "Error al editar el usuario: " . $e->getMessage();
            return false;
        }
    }
}
