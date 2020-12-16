<?php
include_once 'viveduoc.servicio/RegionServicio.php';
include_once 'viveduoc.servicio/AlumnoServicio.php';
include_once 'viveduoc.servicio/CursoServicio.php';
include_once 'viveduoc.servicio/InscripcionServicio.php';
include_once 'viveduoc.servicio/ComunaServicio.php';
include_once 'viveduoc.clases/Helper.php';

$resultadoValidaciones;

if (
    isset($_POST["v_rut"]) && isset($_POST["v_nombre"]) && isset($_POST["v_lastname"]) && isset($_POST["v_lastname2"])
    && isset($_POST["v_email"]) && isset($_POST["v_phone"]) && isset($_POST["v_region"]) && isset($_POST["v_comuna"]) && isset($_POST["v_curso"]) && isset($_POST["v_estadoacademico"])
) {
    $rut = $_POST["v_rut"];
    //Helper::validaRut($rut) ? 'Es válido' : 'Rut no válido :( ';
    $nombres = $_POST["v_nombre"];
    $apellidoPaterno = $_POST["v_lastname"];
    $apellidoMaterno = $_POST["v_lastname2"];
    $email = $_POST["v_email"];
    $telefono = $_POST["v_phone"];
    $region = $_POST["v_region"];
    $comuna = $_POST["v_comuna"];
    $idCurso = $_POST["v_curso"];
    $estadoAcademico = $_POST["v_estadoacademico"];

    $comunaServicio = new ComunaServicio();
    $comunasCapturadas = $comunaServicio->getAllComunasPorRegion($region);

    $resultadoValidaciones = HELPER::validarFormularioInscripcion($rut, $nombres, $apellidoPaterno, $apellidoMaterno, $email, $telefono, $region, $comuna, $idCurso, $estadoAcademico);

    if ($resultadoValidaciones["error"]["estado"] == True) {
        $resultado['success'] = False;
        $resultado['errores'] = $resultadoValidaciones;
        die(json_encode($resultado));
    } else {
        //ALUMNO
        $alumno = new Alumno();
        $alumno->setRut($rut);
        $alumno->setNombres($nombres);
        $alumno->setApellidoPaterno($apellidoPaterno);
        $alumno->setApellidoMaterno($apellidoMaterno);
        $alumno->setEmail($email);
        $alumno->setTelefono($telefono);
        $alumno->setRegion($region);
        $alumno->setComuna($comuna);
        $alumno->setEstadoAcademico($estadoAcademico);

        $alumnoServicio = new AlumnoServicio();
        //Busca alumno
        $alumnoBD = $alumnoServicio->getAlumnoByRut($rut);
        //Se crea alumno
        if ($alumnoBD == null) {
            $alumnoServicio->addAlumno($alumno);
        } else {
            if (seActualizoUnCampo($alumnoBD, $alumno) == True) {
                $alumnoServicio->updateAlumno($alumno);
            } else {
                $alumno = $alumnoBD;
            }
        }

        //CURSOS
        $cursoServicio = new CursoServicio();
        $cursos = $cursoServicio->getAllCursos();
        $curso = $cursoServicio->getCursoByCodigo($idCurso);
        if ($curso == null) {
            $resultadoValidaciones["error"]["estado"] = True;
            $resultadoValidaciones["error"]["msg"] = "Curso no encontrado";

            $resultado['success'] = False;
            $resultado['errores'] = $resultadoValidaciones;
            die(json_encode($resultado));
        }

        //INSCRIPCION
        $inscripcionServicio = new InscripcionServicio();
        //BOOLEAN
        $SeEncuentraInscrito = $inscripcionServicio->inscripcionRepetida($alumno->getRut(), $curso->getCodigo());

        if ($SeEncuentraInscrito == true) {
            //Se encuentra inscrito
            $errorInscripcionRepetida["error"]["estado"] = True;
            $errorInscripcionRepetida["error"]["msg"] = ucwords($alumno->getNombres())." ya te has registrado a este curso.";
            $resultado['success'] = False;
            $resultado['errores'] = $errorInscripcionRepetida;

            die(json_encode($resultado));
        } else {
            //Nueva Inscripcion
            $inscripcionServicio->addInscripcion($alumno, $curso);
            //$resultado = 'exito';
            $resultado['success'] = True;
            $resultado['nombres'] = ucwords($nombres);   
        }

        exit(json_encode($resultado));
    }

    /*
        echo json_encode(array(
            'error' => array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ),
        ));
        */
} else {
    $resultadoValidaciones["error"]["estado"] = True;
    $resultadoValidaciones["error"]["msg"] = "Valor de entrada nulo";

    $resultado['success'] = False;
    $resultado['errores'] = $resultadoValidaciones;
    die(json_encode($resultado));
}

function seActualizoUnCampo($alumnoBD, $alumno)
{
    //Compara strings ignorando mayusculas
    if (strcasecmp($alumnoBD->getNombres(), $alumno->getNombres())) {
        return true;
    }
    if (strcasecmp($alumnoBD->getApellidoPaterno(), $alumno->getApellidoPaterno())) {
        return true;
    }
    if (strcasecmp($alumnoBD->getApellidoMaterno(), $alumno->getApellidoMaterno())) {
        return true;
    }
    if (strcasecmp($alumnoBD->getEmail(), $alumno->getEmail())) {
        return true;
    }
    if (strcasecmp($alumnoBD->getTelefono(), $alumno->getTelefono())) {
        return true;
    }
    if ($alumnoBD->getRegion() != $alumno->getRegion()) {
        return true;
    }
    if ($alumnoBD->getComuna() != $alumno->getComuna()) {
        return true;
    }

    return false;
}