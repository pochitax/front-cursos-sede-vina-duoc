<?php

include_once 'viveduoc.clases/Usuario.php';
include_once 'viveduoc.clases/ConnexionViveDuoc.php';

class UsuarioServicio{
    
    private $db = null;

    function __construct()
    {
        $this->db = new ConexionViveDuoc();
    }

    public function getUsuario($nombreUsuario, $password)
    {
        $usuario = null;
        //$sentencia = $this->db->connect()->prepare("SELECT nombre_usuario FROM avd_usuario WHERE nombre_usuario = ? AND password = ? ;");
        $sentencia = $this->db->connect()->prepare("SELECT nombre_usuario FROM avd_usuario WHERE nombre_usuario = :username AND password = :pass ;");
        $sentencia->bindValue(':username', $nombreUsuario);
        $sentencia->bindValue(':pass', $password);
        $sentencia->execute();
        $elemento = $sentencia->fetch(PDO::FETCH_OBJ);
        if ($elemento === FALSE) {
            #echo("Usuario no existe");
        } else {
            $usuario = new Usuario();
            $usuario->setNombreUsuario($elemento->nombre_usuario);
        }
        return $usuario;
    }
}
