<?php
include_once 'viveduoc.clases/Curso.php';
include_once 'viveduoc.clases/ConnexionViveDuoc.php';

class CursoServicio
{
    private $db = null;

    function __construct()
    {
        $this->db = new ConexionViveDuoc();
    }

    public function getCursoByCodigo($codigo)
    {
        //echo("CODIGO CURSO: ". $codigo);
        $curso = null;
        $sentencia = $this->db->connect()->prepare("SELECT * FROM  avd_curso WHERE codigo = ?;");
        $sentencia->execute([$codigo]);
        $elemento = $sentencia->fetch(PDO::FETCH_OBJ);
        if ($elemento === FALSE) {
            //echo ("No existe el curso");
        } else {
            $curso = new Curso();
            $curso->setCodigo($elemento->codigo);
            $curso->setDescripcion($elemento->descripcion);
            $curso->setCarrera($elemento->carrera);
        }
        return $curso;
    }

    public function getAllCursos()
    {
        $cursos = array();
        $sql = "select codigo, descripcion, carrera from avd_curso";
        $result = $this->db->connect()->prepare($sql);
        $result->execute();
        $elementos = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($elementos as $elemento) {
            $curso = new Curso();
            $curso->setCodigo($elemento->codigo);
            $curso->setDescripcion($elemento->descripcion);
            $curso->setCarrera($elemento->carrera);
            array_push($cursos, $curso);
        }
        return $cursos;
    }
}
