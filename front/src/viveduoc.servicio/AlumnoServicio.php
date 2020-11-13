<?php
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
        $sql = "INSERT INTO avd_alumno(rut, nombres, apellido_paterno, apellido_materno, email, telefono, region, comuna, last_update) VALUES(:rut,:nombres,:apellido_paterno,:apellido_materno,:email,:telefono,:region,:comuna, now())";
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
            //echo ("No existe el alumno");
        } else {
            $alumno = new Alumno();
            $alumno->setRut($elemento->rut);
            $alumno->setNombres($elemento->nombres);
            $alumno->setApellidoPaterno($elemento->apellido_paterno);
            $alumno->setApellidoMaterno($elemento->apellido_materno);
            $alumno->setEmail($elemento->email);
            $alumno->setTelefono($elemento->telefono);
            $alumno->setRegion($elemento->region);
            $alumno->setComuna($elemento->comuna);
        }
        return $alumno;
    }

    public function updateAlumno($alumno){
        $rut = $alumno->getRut();
        $nombres = $alumno->getNombres();
        $apellido_paterno = $alumno->getApellidoPaterno();
        $apellido_materno = $alumno->getApellidoMaterno();
        $email = $alumno->getEmail();
        $telefono = $alumno->getTelefono();
        $region = $alumno->getRegion();
        $comuna = $alumno->getComuna();

        $sql = "UPDATE avd_alumno SET nombres = :nombres, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, 
        email = :email, telefono = :telefono, region = :region, comuna = :comuna, last_update = now() WHERE rut = :rut";
        $sql = $this->db->connect()->prepare($sql);

        $sql->bindParam(':nombres', $nombres, PDO::PARAM_STR, 50);
        $sql->bindParam(':apellido_paterno', $apellido_paterno, PDO::PARAM_STR, 50);
        $sql->bindParam(':apellido_materno', $apellido_materno, PDO::PARAM_STR, 50);
        $sql->bindParam(':email', $email, PDO::PARAM_STR, 254);
        $sql->bindParam(':telefono', $telefono, PDO::PARAM_STR, 45);
        $sql->bindParam(':region', $region, PDO::PARAM_STR, 64);
        $sql->bindParam(':comuna', $comuna, PDO::PARAM_STR, 64);
        $sql->bindParam(':rut', $rut, PDO::PARAM_STR, 12);

        $sql->execute();
    }
}
