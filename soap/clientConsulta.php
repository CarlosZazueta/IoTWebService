<?php
    include_once("lib/nusoap.php");
    $url = "http://localhost/Tareas/soap/service.php";
    $cliente = new nusoap_client($url, false);

    $codigo = 0;

    $listado = $cliente->call('select',array("idArticulo" => $codigo), "uri:".$url, "uri:".$url."/select");
    print_r($listado);
?>