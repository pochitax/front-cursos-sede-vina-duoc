<?php
include_once 'viveduoc.servicio/ComunaServicio.php';

$region = $_GET["v_region"];
if ($region >= 1 && $region <= 16) {
    $comunaServicio = new ComunaServicio();
    $comunas = $comunaServicio->getAllComunasPorRegion($region);

    $arrComunas = array();

    for ($i = 0; $i < count($comunas); $i++) {

        $comuna = array('cod' => $comunas[$i]->getId(), 'desc' => $comunas[$i]->getDescripcion());
        array_push($arrComunas, $comuna);
    }
    
    echo json_encode($arrComunas);
}
