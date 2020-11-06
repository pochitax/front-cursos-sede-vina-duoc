<?php
class Curso
{
    private $codigo;
    private $descripcion;
    private $carrera;

    function getCodigo()
    {
        return $this->codigo;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getCarrera()
    {
        return $this->carrera;
    }

    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setCarrera($carrera)
    {
        $this->carrera = $carrera;
    }
}
