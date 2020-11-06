<?php

include_once 'viveduoc.clases/Region.php';
include_once 'viveduoc.clases/ConnexionViveDuoc.php';

class RegionServicio
{
    private $conn;

    function __construct()
    {
        $this->db = new ConexionViveDuoc();
    }

    public function getRegionById($id)
    {
        $region = null;
        $sentencia = $this->db->connect()->prepare("SELECT * FROM avd_region WHERE id = ?;");
        $sentencia->execute([$id]);
        $elemento = $sentencia->fetch(PDO::FETCH_OBJ);
        if ($elemento === FALSE) {
            #No existe
            echo "¡No existe region con ese ID!";
            exit();
        } else {
            $region = new Region();
            $region->setId($elemento->id);
            $region->setDescripcion($elemento->descripcion);
            $region->setAbreviatura($elemento->abreviatura);
            $region->setCapital($elemento->capital);
        }
        return $region;
    }

    public function getAllRegions()
    {
        $regiones = array();
        $sql = "select id, descripcion from avd_region";
        $result = $this->db->connect()->prepare($sql);
        $result->execute();
        $elementos = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($elementos as $elemento) {
            $region = new Region();
            $region->setId($elemento->id);
            $region->setDescripcion($elemento->descripcion);
            array_push($regiones, $region);
        }
        return $regiones;
    }
}
