<?php

session_start();

include_once './controlador/ctrlUsuario.php';
include_once './modelo/mdlUsuario.php';
include_once './modelo/Conexion.php';
include_once './modelo/popos/usuario.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'GET') {
    $json = isset($_GET['json']) ? urldecode($_GET['json']) : null;
} else {
    $json = file_get_contents('php://input');
}

$objAnonimo = json_decode($json);

$estado = 200;
$estadoDesc = 'Ok';

$ctrlUsuarios = new ctrlUsuarios();

switch ($requestMethod) {
    case 'GET':
        if ($objAnonimo == null) {
            $respuesta = json_encode($ctrlUsuarios->buscarUsuarios());
        } else {
            $respuesta = json_encode(
                $ctrlUsuarios->validarUsuario(
                    $objAnonimo->idUsuario,
                    $objAnonimo->contrasenia
                )
            );
        }
        break;
        case 'POST':
            
            break;

        case 'PUT':
           
            break;
    default:
        $estado = 488;
        break;
}

header_remove('Set-Cookie');
http_response_code($estado);
header('status: ' . $estado);
header('Access-Control-Allow-Headers: Authorization, Origin, Content-Type, Accept, Access-Control-Allow-Request-Method');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo $respuesta;

die();
