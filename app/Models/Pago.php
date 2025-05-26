<?php

namespace App\Models;

class Pago
{
    private $id;
    private $idUsuario;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $codigoPostal;
    private $estado;
    private $municipio;
    private $calle;
    private $numeroExterior;
    private $numeroInterior;
    private $numeroTarjeta;
    private $cvc;
    private $mes;
    private $ano;
    private $isActivo;

    // Getters y Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    public function getNumeroExterior()
    {
        return $this->numeroExterior;
    }

    public function setNumeroExterior($numeroExterior)
    {
        $this->numeroExterior = $numeroExterior;
    }

    public function getNumeroInterior()
    {
        return $this->numeroInterior;
    }

    public function setNumeroInterior($numeroInterior)
    {
        $this->numeroInterior = $numeroInterior;
    }

    public function getNumeroTarjeta()
    {
        return $this->numeroTarjeta;
    }

    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numeroTarjeta = $numeroTarjeta;
    }

    public function getCvc()
    {
        return $this->cvc;
    }

    public function setCvc($cvc)
    {
        $this->cvc = $cvc;
    }

    public function getMes()
    {
        return $this->mes;
    }

    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    public function getIsActivo()
    {
        return $this->isActivo;
    }

    public function setIsActivo($isActivo)
    {
        $this->isActivo = $isActivo;
    }
}
