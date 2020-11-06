<?php

class Alumno {
    private $rut;
    private $nombres;
    private $apellido_paterno;
    private $apellido_materno;
    private $email;
    private $telefono;
    private $region;
    private $comuna;

    //getters
    function getRut(){
        return $this->rut;
    }

    function getNombres(){
        return $this->nombres;
    }

    function getApellidoPaterno(){
        return $this->apellido_paterno;
    }

    function getApellidoMaterno(){
        return $this->apellido_materno;
    }

    function getEmail(){
        return $this->email;
    }

    function getTelefono(){
        return $this->telefono;
    }

    function getRegion(){
        return $this->region;
    }

    function getComuna(){
        return $this->comuna;
    }

    
    //setters
    function setRut($rut){
        $this->rut = $rut;
    }

    function setNombres($nombres){
        $this->nombres = $nombres;
    }

    function setApellidoPaterno($apellido_paterno){
        $this->apellido_paterno = $apellido_paterno;
    }

    function setApellidoMaterno($apellido_materno){
        $this->apellido_materno = $apellido_materno;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    function setRegion($region){
        $this->region = $region;
    }

    function setComuna($comuna){
        $this->comuna = $comuna;
    }
}