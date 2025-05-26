<?php

namespace App\Daos;

use App\Clases\Database;

class PagoDao
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($pago)
    {
        try {
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // Activar el modo de error de PDO
            $sql = "INSERT INTO TBL_PAGOS (
                        ID_USUARIO, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, 
                        CODIGO_POSTAL, ESTADO, MUNICIPIO, CALLE, 
                        NUMERO_EXTERIOR, NUMERO_INTERIOR, NUMERO_TARJETA, CVC, 
                        MES, YEAR, IS_ACTIVO
                    ) VALUES (
                        :ID_USUARIO, :NOMBRE, :APELLIDO_PATERNO, :APELLIDO_MATERNO, 
                        :CODIGO_POSTAL, :ESTADO, :MUNICIPIO, :CALLE, 
                        :NUMERO_EXTERIOR, :NUMERO_INTERIOR, :NUMERO_TARJETA, :CVC, 
                        :MES, :YEAR, :IS_ACTIVO
                    )";
            $stmt = $this->db->prepare($sql);

            $idUsuario = $pago->getIdUsuario();
            $nombre = $pago->getNombre();
            $apellidoPaterno = $pago->getApellidoPaterno();
            $apellidoMaterno = $pago->getApellidoMaterno();
            $codigoPostal = $pago->getCodigoPostal();
            $estado = $pago->getEstado();
            $municipio = $pago->getMunicipio();
            $calle = $pago->getCalle();
            $numeroExterior = $pago->getNumeroExterior();
            $numeroInterior = $pago->getNumeroInterior();
            $numeroTarjeta = $pago->getNumeroTarjeta();
            $cvc = $pago->getCvc();
            $mes = $pago->getMes();
            $ano = $pago->getAno();
            $isActivo = $pago->getIsActivo();

            $stmt->bindParam(':ID_USUARIO', $idUsuario);
            $stmt->bindParam(':NOMBRE', $nombre);
            $stmt->bindParam(':APELLIDO_PATERNO', $apellidoPaterno);
            $stmt->bindParam(':APELLIDO_MATERNO', $apellidoMaterno);
            $stmt->bindParam(':CODIGO_POSTAL', $codigoPostal);
            $stmt->bindParam(':ESTADO', $estado);
            $stmt->bindParam(':MUNICIPIO', $municipio);
            $stmt->bindParam(':CALLE', $calle);
            $stmt->bindParam(':NUMERO_EXTERIOR', $numeroExterior);
            $stmt->bindParam(':NUMERO_INTERIOR', $numeroInterior);
            $stmt->bindParam(':NUMERO_TARJETA', $numeroTarjeta);
            $stmt->bindParam(':CVC', $cvc);
            $stmt->bindParam(':MES', $mes);
            $stmt->bindParam(':YEAR', $ano);
            $stmt->bindParam(':IS_ACTIVO', $isActivo);

            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            echo "Error al crear pago: " . $e->getMessage();
            return false;
        }
    }
}
