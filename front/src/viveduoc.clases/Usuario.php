<?php

class Usuario
{
    private $nombreUsuario;
    private $password;
    private $rol;

    function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    function getPassword(){
        return $this->password;
    }

    function getRol(){
        return $this->rol;
    }

    function setNombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }

    function setPassword($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
    }

    function setRol($rol){
        $this->rol = $rol;
    }

}
