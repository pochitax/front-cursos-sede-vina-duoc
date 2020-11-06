<?php
class Inscripcion{
    private $id;
    private $fechaIncripcion;
    private $alumnoRut;
    private $cursoCodigo;

    function getId(){
        return $this->id;
    }

    function getFechaInscripcion(){
        return $this->fechaIncripcion;
    }

    function getAlumnoRut(){
        return $this->alumnoRut;
    }

    function getCursoCodigo(){
        return $this->cursoCodigo;
    }
    
    function setId($id){
        $this->id = $id;
    }

    function setFechaInscripcion($fecha){
        $this->fechaIncripcion = $fecha;
    }

    function setAlumnoRut($alumno_rut){
        $this->alumnoRut = $alumno_rut;
    }

    function setCursoCodigo($curso){
        $this->cursoCodigo = $curso;
    }
}