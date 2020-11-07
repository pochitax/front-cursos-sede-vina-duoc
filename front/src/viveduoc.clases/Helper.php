<?php
class Helper
{
    /**
     *	Función de validación de un rut basado en el algoritmo chileno
     *	el formato de entrada es ########-# en donde deben ser sólo
     *	números en la parte izquierda al guión y número o k en el
     *	dígito verificador
     */
    static function validaRut($rutCompleto)
    {
        $rutCompleto = str_replace(".", "", $rutCompleto);
        if (!preg_match("/^[0-9]+-[0-9kK]{1}/", $rutCompleto)) return false;
        $rut = explode('-', $rutCompleto);
        return strtolower($rut[1]) == Helper::dv($rut[0]);
    }
    static function dv($T)
    {
        $M = 0;
        $S = 1;
        for (; $T; $T = floor($T / 10))
            $S = ($S + $T % 10 * (9 - $M++ % 6)) % 11;
        return $S ? $S - 1 : 'k';
    }

    static function validarFormularioInscripcion($rut, $nombres, $apellidoPaterno, $apellidoMaterno, $email, $telefono, $region, $comuna, $idCurso)
    {
        $validar = array(
            'error' => array('estado' => False, 'msg' => '')
        );

        //NOMBRES
        if (strlen($nombres) > 0 && strlen($nombres) < 100) {
            if (!preg_match("/^[a-zA-Z\s,.'\-\pL]+$/u", $nombres)) {
                $validar['error']['msg'] = 'Nombre incorrecto';
                $validar['error']['estado'] = True;
                return $validar;
            }
        } else {
            $validar['error']['msg'] = 'Nombre incorrecto';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //APELLIDO PATERNO
        if (strlen($apellidoPaterno) == 0 || strlen($apellidoPaterno) > 50) {
            $validar['error']['msg'] = 'Apellido paterno incorrecto';
            $validar['error']['estado'] = True;
            return $validar;
        } elseif (!preg_match("/^[a-zA-Z\s,.'\-\pL]+$/u", $apellidoPaterno)) {
            $validar['error']['msg'] = 'Apellido paterno incorrecto';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //APELLIDO MATERNO
        if (strlen($apellidoMaterno) == 0 || $apellidoMaterno > 50) {
            $validar['error']['msg'] = 'Apellido materno incorrecto';
            $validar['error']['estado'] = True;
            return $validar;
        } elseif (!preg_match("/^[a-zA-Z\s,.'\-\pL]+$/u", $apellidoPaterno)) {
            $validar['error']['msg'] = 'Apellido materno incorrecto';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //RUT
        if (substr_count($rut, ".") != 2 || substr_count($rut, "-") != 1 || strlen($rut) > 12 || strlen($rut) < 3 || Helper::validaRut($rut) == False) {
            $validar['error']['msg'] = 'Rut incorrecto';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //EMAIL
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validar['error']['msg'] = 'Email inválido';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //TELEFONO
        if (strlen($telefono) > 45) {
            $validar['error']['msg'] = 'Telefono inválido';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //CURSO
        if (is_numeric($idCurso) == False || $idCurso < 0 || $idCurso > 22) {
            $validar['error']['msg'] = 'Curso inválido';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //REGION
        if (is_numeric($region) == True && ($region >= 1 && $region <= 16)) {
        } else {
            $validar['error']['msg'] = 'Region inválida';
            $validar['error']['estado'] = True;
            return $validar;
        }

        //COMUNA
        if (is_numeric($comuna) == True && ($comuna >= 1 && $comuna <= 1000)) {
        } else {
            $validar['error']['msg'] = 'Comuna inválida';
            $validar['error']['estado'] = True;
            return $validar;
        }

        return $validar;
    }
}
