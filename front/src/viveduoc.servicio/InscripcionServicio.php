<?php

include_once 'viveduoc.clases/Inscripcion.php';
include_once 'viveduoc.clases/ConnexionViveDuoc.php';

class InscripcionServicio
{
    private $db = null;

    function __construct()
    {
        $this->db = new ConexionViveDuoc();
    }

    public function addInscripcion($alumno, $curso)
    {
        try {
            $rut = $alumno->getRut();
            $codigoCurso = $curso->getCodigo();
            date_default_timezone_set("America/Santiago");
            $fecha = date("Y-m-d H:i:s");
            //echo($fecha);
    
            $sql = "INSERT into avd_inscripcion VALUES (null, :fecha_inscripcion, :alumno_rut, :curso_codigo, :last_update)";
            $sql = $this->db->connect()->prepare($sql);
    
            $sql->bindParam(':fecha_inscripcion', $fecha);
            $sql->bindParam(':alumno_rut', $rut, PDO::PARAM_STR, 12);
            $sql->bindParam(':curso_codigo', $codigoCurso, PDO::PARAM_INT);
            $sql->bindParam(':last_update', $fecha);
    
            $sql->execute();
        } catch (\Throwable $th) {
            //echo("error ". $th);
        }
    }

    public function getInscripcionById($id)
    {
        $inscripcion = null;
        $sentencia = $this->db->connect()->prepare("SELECT * FROM  avd_inscripcion WHERE id = ?;");
        $sentencia->execute([$id]);
        $elemento = $sentencia->fetch(PDO::FETCH_OBJ);
        if ($elemento === FALSE) {
            //echo ("No existe inscripcion");
        } else {
            $inscripcion = new Inscripcion();
            $inscripcion->setId($elemento->inscripcion);
            $inscripcion->setFechaInscripcion($elemento->fecha_inscripcion);
            $inscripcion->setAlumnoRut($elemento->alumno_rut);
            $inscripcion->setCursoCodigo($elemento->curso_codigo);
        }
        return $inscripcion;
    }

    public function listInscripciones()
    {
        $inscripciones = array();
        $sql = "select id, fecha_inscripcion, alumno_rut, curso_codigo from avd_inscripcion";
        $result = $this->db->connect()->prepare($sql);
        $result->execute();
        $elementos = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($elementos as $elemento) {
            $inscripcion = new Inscripcion();
            $inscripcion->setId($elemento->id);
            $inscripcion->setFechaInscripcion($elemento->fecha_inscripcion);
            $inscripcion->setAlumnoRut($elemento->alumno_rut);
            $inscripcion->setCursoCodigo($elemento->curso_codigo);
            array_push($inscripciones, $inscripcion);
        }
        return $inscripciones;
    }

    public function inscripcionRepetida($rut, $cursoCodigo)
    {
        $sql = "SELECT * FROM avd_inscripcion WHERE alumno_rut = ? AND curso_codigo = ?";
        $result = $this->db->connect()->prepare($sql);
        $result->execute([$rut, $cursoCodigo]);
        //$result->execute();
        $elementos = $result->fetchAll(PDO::FETCH_OBJ);
        if(count($elementos) > 0){
            return true;
        }else{
            return false;
        }
    }
}