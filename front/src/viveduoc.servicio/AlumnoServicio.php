<?php
if( count(get_included_files()) == ((version_compare(PHP_VERSION, '5.0.0', '>='))?1:0) )
{
  echo "Direct access not allowed";
    exit();
}

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('Direct access not allowed');
    exit();
};


include_once 'viveduoc.clases/Alumno.php';
include_once 'viveduoc.clases/ConnexionViveDuoc.php';

class AlumnoServicio
{
    private $db = null;

    function __construct()
    {
        $this->db = new ConexionViveDuoc();
    }

    public function addAlumno($alumno)
    {
        $rut = $alumno->getRut();
        $nombres = $alumno->getNombres();
        $apellido_paterno = $alumno->getApellidoPaterno();
        $apellido_materno = $alumno->getApellidoMaterno();
        $email = $alumno->getEmail();
        $telefono = $alumno->getTelefono();
        $region = $alumno->getRegion();
        $comuna = $alumno->getComuna();

        ////////////// Insertar a la tabla la informacion generada /////////
        $sql = "INSERT INTO avd_alumno(rut, nombres, apellido_paterno, apellido_materno, email, telefono, region, comuna) VALUES(:rut,:nombres,:apellido_paterno,:apellido_materno,:email,:telefono,:region,:comuna)";
        $sql = $this->db->connect()->prepare($sql);

        $sql->bindParam(':rut', $rut, PDO::PARAM_STR, 12);
        $sql->bindParam(':nombres', $nombres, PDO::PARAM_STR, 50);
        $sql->bindParam(':apellido_paterno', $apellido_paterno, PDO::PARAM_STR, 50);
        $sql->bindParam(':apellido_materno', $apellido_materno, PDO::PARAM_STR, 50);
        $sql->bindParam(':email', $email, PDO::PARAM_STR, 254);
        $sql->bindParam(':telefono', $telefono, PDO::PARAM_STR, 45);
        $sql->bindParam(':region', $region, PDO::PARAM_STR, 64);
        $sql->bindParam(':comuna', $comuna, PDO::PARAM_STR, 64);

        $sql->execute();

        return $this->db->connect()->lastInsertId();
    }

    public function getAlumnoByRut($rut)
    {
        $alumno = null;
        $sentencia = $this->db->connect()->prepare("SELECT * FROM  avd_alumno WHERE rut = ?;");
        $sentencia->execute([$rut]);
        $elemento = $sentencia->fetch(PDO::FETCH_OBJ);
        if ($elemento === FALSE) {
            echo ("No existe el alumno");
        } else {
            $alumno = new Alumno();
            $alumno->setRut($elemento->rut);
            $alumno->setNombres($elemento->nombres);
            $alumno->setApellidoPaterno($elemento->apellido_paterno);
            $alumno->setEmail($elemento->email);
            $alumno->setTelefono($elemento->telefono);
            $alumno->setRegion($elemento->region);
            $alumno->setComuna($elemento->comuna);
        }
        return $alumno;
    }
}
