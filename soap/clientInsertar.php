<?php
    include_once("lib/nusoap.php");
    $url = "http://localhost/Tareas/soap/service.php";
    $cliente = new nusoap_client($url, false);

    $nombre = "botas";
    $cantidad = 13;

    $mensaje = $cliente->call('insert',array("nombre" => $nombre, "cantidad"=>$cantidad), "uri:".$url, "uri:".$url."/insert");
    print_r($mensaje);
?>