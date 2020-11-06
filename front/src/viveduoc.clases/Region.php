<?php

class Region
{
    private $id;
    private $descripcion;
    private $abreviatura;
    private $capital;

    function getId()
    {
        return $this->id;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getAbreviatura()
    {
        return $this->abreviatura;
    }

    function getCapital()
    {
        return $this->capital;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    }

    function setCapital($capital)
    {
        $this->capital = $capital;
    }
}
