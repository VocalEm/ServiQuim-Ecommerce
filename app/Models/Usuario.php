<?php

namespace App\Models;

class Usuario
{

    private $id;
    private $correo;
    private $nombre;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $password;
    private $telefono;
    private $isAdmin;

    public function getId()
    {
        return $this->correo;
    }

    public function setId($_id)
    {
        $this->id = $_id;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($_correo)
    {
        $this->correo = $_correo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($_nombre)
    {
        $this->nombre = $_nombre;
    }

    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno($_apellidoPaterno)
    {
        $this->apellidoPaterno = $_apellidoPaterno;
    }

    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno($_apellidoMaterno)
    {
        $this->apellidoMaterno = $_apellidoMaterno;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($_password)
    {
        $this->password = $_password;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($_telefono)
    {
        $this->telefono = $_telefono;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($_isAdmin)
    {
        $this->isAdmin = $_isAdmin;
    }
}
