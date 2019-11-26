<?php
    include_once("lib/nusoap.php"); // Libreria NuSoap
    require_once("../crud/database.php"); // Clase con conexion a BD MySql
    $url = "http://localhost/Tareas/soap/service.php";
    $server = new nusoap_server();
    $server->configureWSDL("consulta", $url); // Este nombre es el que se le da al servicio
    $server->wsdl->schemaTargetNamespace = $url;
    $server->soap_defencoding = "utf-8";
    $server->register(
        "select",
        array("idArticulo" => "xsd:integer"),
        array("return" => "xsd:string"),
        $url      
    );
    $server->register(
        "insert",
        array("nombre"=>"xsd:string", "cantidad"=>"xsd:integer"),
        array("return"=>"xsd:string"),
        $url
    );

    function select($idArticulo){
        $con = new Database();
        $listado = $con->read($idArticulo);

        $i = 0;

        $xml = "<?xml version='1.0' encoding='utf-8'?>";
        if ($listado != null) {
            $xml.="<Articulos>";
            while ($row = mysqli_fetch_object($listado)) {
                $xml.="<Articulo>";
                $xml.="<idArticulo>" ."Id: " . $row->idArticulo ."</idArticulo> ";
                $xml.="<br>";
                $xml.="<nombre>" ."Articulo: " . $row->nombre ."</nombre> ";
                $xml.="<br>";
                $xml.="<cantidad>" ."Cantidad: " . $row->cantidad ."</cantidad> ";
                $xml.="<br>";
                $xml.="</Articulo>";
                $xml.="<br><br>";
                $i++;
            }
           
        } else {
            $xml.="<error>Error consulta vacía</error>";
        }

        $xml.="</Articulos>";
        
        $respuesta = new soapval("return", "xsd:string", $xml);
        return $respuesta;
    }
    
    function insert($nombre, $cantidad){
        $con = new Database();
        $nombre = $con->sanitize($nombre);
        $cantidad = $con->sanitize($cantidad);
        $insert = $con->create($nombre, $cantidad);

        $xmlMessage = "<?xml version='1.0' encoding='utf-8'?>";
        $xmlMessage .= "<Mensajes>";

        if($insert){
            $xmlMessage.="<mensaje>Exito al insertar datos</mensaje>";
        } else {
            $xmlMessage.="<mensaje>Error al insertar datos</mensaje>";
        }

        $xmlMessage.="</Mensajes>";
        
        $respuesta = new soapval("return", "xsd:string", $xmlMessage);
        return $respuesta;
    }

    // Esto es importantisimo
    if (!isset($HTTP_RAW_POST_DATA)) {
        $HTTP_RAW_POST_DATA = file_get_contents('php://input');
        $server->service($HTTP_RAW_POST_DATA);
    }
?>