<?php
//no bloquee el contenido
if (isset($_SERVER['HTTP_ORIGIN']))
{
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Max-Age:86400'); //cache por un dia 
}

//ESTABLECE FORMATO DE ENTRADA PARA APPLICATION/JSON
if(strcasecmp($_SERVER['REQUEST_METHOD'],'POST') != 0)
{
    throw new Exception("EL METODO DEBERIA SER POST");
}

//Establece que el formato de entrada será application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}


//RECIBE EL RAW
$content = trim(file_get_contents("php://input"));

//transdorma el raw json a php
$decoded = json_decode($content,true); //guarda la peticion

$message = array(); //guardar las respuestas

require 'Config/Conexion.php';
require 'api/apiTest.php';

$miAPI = new Consultas();
    
    switch ($decoded['action']) {
        case "mostrar_ubicasiones":
            if (is_array($data = $miAPI->consultar()))
            {
                $message = $data;
            } 
            else 
            {
                $message["message"] = "Error en la acción ubicacion.";
            }        
            break;

        case "mostrar_proveedor":
            if (is_array($data = $miAPI->listarproveedor())) {
                $message = $data;
            } else {
                $message["message"] = "Error en la acción Listar Artistas.";
            }        
            break;

        case "mostrar_pedidos": //devuelve los generos
            if (is_array($data = $miAPI->listarPedidos())) {
                $message = $data;
            } else {
                $message["message"] = "Error en la acción Listar Artistas.";
            }        
            break;

        case "mostrar_cantidad_ubicasion_pedido": //cuantas canciones hay por genero
            if(isset($decoded['gender'])){
                if (is_array($data = $miAPI->ennumerarUbicasiones($decoded['gender']))) {
                $message = $data;
                } else {
                $message["message"] = "Error en la acción EnnumerarCanciones.";
                }   
                } 
                else{
                $message["message"] = "Error, elige un genero";
            }
            break;

        case "filtrar_ubicasiones_pedido":
            if(isset($decoded['idPedido'])){
                if (is_array($data = $miAPI->listar_ubicaciones_por_pedido($decoded['idPedido']))) {
                    $message = $data;
                } else {
                   $message["message"] = "Error en la acción Listar pedido";
                }  
            }else{
                $message["message"] = "Error, elige un pedido";
            }
            break;

        case "agregar_ubicasion":
            if(isset($decoded['idUbicasion']) and
                isset($decoded['Ciudad']) and 
                isset($decoded['Proveedor']) and 
                isset($decoded['Fecha_llegada']) and 
                isset($decoded['idPedido'])){
                if (is_array($data = $miAPI->agregar_ubicasion($decoded['idUbicasion'],$decoded['Ciudad'], $decoded['Proveedor'], $decoded['Fecha_llegada'], $decoded['idPedido']))) {
                    $message = $data;
                } else {
                   $message["message"] = "Error al intentar insertar una ubicacion.";
                }  
            }
                else{
                   $message["message"] = "Error, Faltan datos";
            }
            break;

        case "agregar_pedido":
            if(isset($decoded['Destino']) and 
                isset($decoded['referencias']) and 
                isset($decoded['Origen']) and 
                isset($decoded['Precio']) and 
                isset($decoded['Nombre_Cliente'])and
                isset($decoded['estado_pedido'])){
                if (is_array($data = $miAPI->agregar_pedido($decoded['Destino'],$decoded['referencias'], $decoded['Origen'], $decoded['Precio'],$decoded['Nombre_Cliente'],$decoded['estado_pedido']))) {
                    $message = $data;
                } else {
                    $message["message"] = "Error al intentar insertar un genero.";
                }  
            }else{
                $message["message"] = "Error, Faltan datos";
            }
            break;
        default:
            $message["message"] = "Acción NO válida";
            break;
    }

    //Codificar a JSON y mostrarlo en pantalla
    header('Content-type: application/json; charset=utf-8');
    $miJSON = json_encode($message, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    print $miJSON;