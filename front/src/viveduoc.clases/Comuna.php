<?php

class Comuna
{
    private $id;
    private $descripcion;
    private $provinciaId;

    function getId()
    {
        return $this->id;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getProvinciaId()
    {
        return $this->provinciaId;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setProvinciaId($provId)
    {
        $this->provinciaId = $provId;
    }
}
