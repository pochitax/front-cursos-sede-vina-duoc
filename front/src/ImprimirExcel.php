<?php

require 'vendor/autoload.php';
include 'viveduoc.servicio/InscripcionServicio.php';
include 'viveduoc.servicio/AlumnoServicio.php';
include 'viveduoc.servicio/CursoServicio.php';
include 'viveduoc.servicio/RegionServicio.php';
include 'viveduoc.servicio/ComunaServicio.php';
include 'viveduoc.servicio/UsuarioServicio.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST["uname"]) && isset($_POST["psw"]) && isset($_POST["request"])) {
    $requestValue = $_POST["request"];
    if ($requestValue == "request_1") {
        $nombreUsuario = $_POST["uname"];
        $contrasena = $_POST["psw"];
        $usuarioServicio = new UsuarioServicio();
		
		$contrasena = md5($contrasena);
		
        $usuario = $usuarioServicio->getUsuario($nombreUsuario, $contrasena);

        if ($usuario != null) {
            $inscripcionServicio = new InscripcionServicio();
            $alumnoServicio = new AlumnoServicio();
            $cursoServicio = new CursoServicio();
            $regionServicio = new RegionServicio();
            $comunaServicio = new ComunaServicio();

            $inscripciones = $inscripcionServicio->listInscripciones();

            //Generando archivo Excel .xlsx
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'NUMERO');
            $sheet->setCellValue('B1', 'CURSO');
            $sheet->setCellValue('C1', 'RUT');
            $sheet->setCellValue('D1', 'NOMBRES');
            $sheet->setCellValue('E1', 'APELLIDOS');
            $sheet->setCellValue('F1', 'EMAIL');
            $sheet->setCellValue('G1', 'TELEFONO');
            $sheet->setCellValue('H1', 'REGION');
            $sheet->setCellValue('I1', 'COMUNA');
            $sheet->setCellValue('J1', 'FECHA');
            $sheet->setCellValue('K1', 'HORA');

            $regiones = $regionServicio->getAllRegions();
            $comunas = $comunaServicio->getAllComunas();
            $cursos = $cursoServicio->getAllCursos();
            $region = null;
            $comuna = null;
            $curso = null;

            for ($i = 0; $i < count($inscripciones); $i++) {
                $fila = $i + 2;

                $alumno = $alumnoServicio->getAlumnoByRut($inscripciones[$i]->getAlumnoRut());
                $insCursoCodigo = $inscripciones[$i]->getCursoCodigo();

                foreach ($cursos as $cur) {
                    if ($cur->getCodigo() == $insCursoCodigo) {
                        $curso = $cur;
                        break;
                    }
                }

                foreach ($regiones as $reg) {
                    if ($reg->getId() == $alumno->getRegion()) {
                        $region = $reg;
                        break;
                    }
                }

                foreach ($comunas as $com) {
                    if ($com->getId() == $alumno->getComuna()) {
                        $comuna = $com;
                        break;
                    }
                }

                //$curso = $cursoServicio->getCursoByCodigo($inscripciones[$i]->getCursoCodigo());
                //$region = $regionServicio->getRegionById($alumno->getRegion());
                //$comuna = $comunaServicio->getComunaById($alumno->getComuna());

                $date = new DateTime($inscripciones[$i]->getFechaInscripcion());
                $fechaDias = $date->format('Y-m-d');
                $fechaHoras = $date->format('H:i:s');

                $sheet->setCellValue('A' . $fila, $i + 1);
                $sheet->setCellValue('B' . $fila,  $curso->getDescripcion());
                $sheet->setCellValue('C' . $fila,  $inscripciones[$i]->getAlumnoRut());
                $sheet->setCellValue('D' . $fila,  ucwords($alumno->getNombres()));
                $sheet->setCellValue('E' . $fila,  ucwords($alumno->getApellidoPaterno()) . ' ' . ucwords($alumno->getApellidoMaterno()));
                $sheet->setCellValue('F' . $fila,  $alumno->getEmail());
                $sheet->setCellValue('G' . $fila,  $alumno->getTelefono());
                $sheet->setCellValue('H' . $fila,  $region->getDescripcion());
                $sheet->setCellValue('I' . $fila,  $comuna->getDescripcion());
                $sheet->setCellValue('J' . $fila,  $fechaDias);
                $sheet->setCellValue('K' . $fila,  $fechaHoras);
            }

            //Redimensionamiento de celdas
            foreach (range('A', 'K') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            $filename = 'Prospectos Cursos Viña del Mar-' . time() . '.xlsx';
            // Redirect output to a client's web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        } else {
            header("Location: ../reporte.php");
            die();
        }
    }else{
        //echo("Sin permisos");
    }
}
