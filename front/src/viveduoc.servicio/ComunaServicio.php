<?php
include_once 'viveduoc.clases/Comuna.php';
include_once 'viveduoc.clases/ConnexionViveDuoc.php';

class ComunaServicio
{
    private $db = null;

    function __construct()
    {
        $this->db = new ConexionViveDuoc();
    }

    public function getComunaById($id)
    {
        $comuna = null;
        $sentencia = $this->db->connect()->prepare("SELECT * FROM  avd_comuna WHERE id = ?;");
        $sentencia->execute([$id]);
        $elemento = $sentencia->fetch(PDO::FETCH_OBJ);
        if ($elemento === FALSE) {
            //echo ("No existe el curso");
        } else {
            $comuna = new Comuna();
            $comuna->setId($elemento->id);
            $comuna->setDescripcion($elemento->descripcion);
            $comuna->setProvinciaId($elemento->provincia_id);
        }
        return $comuna;
    }

    public function getAllComunas()
    {
        $comunas = array();
        $sql = "select id, descripcion, provincia_id from avd_comuna";
        $result = $this->db->connect()->prepare($sql);
        $result->execute();
        $elementos = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($elementos as $elemento) {
            $comuna = new Comuna();
            $comuna->setId($elemento->id);
            $comuna->setDescripcion($elemento->descripcion);
            $comuna->setProvinciaId($elemento->provincia_id);
            array_push($comunas, $comuna);
        }
        return $comunas;
    }

    public function getAllComunasPorRegion($codigoRegion)
    {
        $comunas = array();
        //$sql = "select id, descripcion, provincia_id from avd_comuna";
        $sql = "SELECT com.id, com.descripcion, com.provincia_id FROM avd_comuna com INNER JOIN avd_provincia prov ON com.provincia_id = prov.id WHERE prov.region_id = ?;";
        $result = $this->db->connect()->prepare($sql);
        $result->execute([$codigoRegion]);
        $elementos = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($elementos as $elemento) {
            $comuna = new Comuna();
            $comuna->setId($elemento->id);
            $comuna->setDescripcion($elemento->descripcion);
            $comuna->setProvinciaId($elemento->provincia_id);
            array_push($comunas, $comuna);
        }
        
        return $comunas;
    }
}
