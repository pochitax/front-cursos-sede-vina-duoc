<?php

class Alumno
{
    private $rut;
    private $nombres;
    private $apellido_paterno;
    private $apellido_materno;
    private $email;
    private $telefono;
    private $region;
    private $comuna;
    private $estado_academico;
    private $edad;

    //getters
    function getRut()
    {
        return $this->rut;
    }

    function getNombres()
    {
        return $this->nombres;
    }

    function getApellidoPaterno()
    {
        return $this->apellido_paterno;
    }

    function getApellidoMaterno()
    {
        return $this->apellido_materno;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getTelefono()
    {
        return $this->telefono;
    }

    function getRegion()
    {
        return $this->region;
    }

    function getComuna()
    {
        return $this->comuna;
    }

    function getEstadoAcademico()
    {
        return $this->estado_academico;
    }

    function getEdad(){
        return $this->edad;
    }


    //setters
    function setRut($rut)
    {
        $this->rut = $rut;
    }

    function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    function setApellidoPaterno($apellido_paterno)
    {
        $this->apellido_paterno = $apellido_paterno;
    }

    function setApellidoMaterno($apellido_materno)
    {
        $this->apellido_materno = $apellido_materno;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    function setRegion($region)
    {
        $this->region = $region;
    }

    function setComuna($comuna)
    {
        $this->comuna = $comuna;
    }

    function setEstadoAcademico($estado_academico)
    {
        switch ($estado_academico) {
            case '1':
                $estado_academico = 'Estudiante de Enseñanza Media';
                break;
            case '2':
                $estado_academico = 'Postulante a la Educación Superior';
                break;
            case '3':
                $estado_academico = 'Estudiante Universitario';
                break;
            case '4':
                $estado_academico = 'Profesional';
                break;
            default:
                # code...
                break;
        }
        $this->estado_academico = $estado_academico;
    }

    function setEdad($edad){
        $this->edad = $edad;
    }
}
