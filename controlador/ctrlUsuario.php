<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include_once './modelo/mdlUsuario.php';
include_once './modelo/popos/usuario.php'; 

class ctrlUsuarios {

    function validarUsuario($rfc, $contrasenia) {
        $mdlUsuario = new mdlUsuario();
        $resultado = $mdlUsuario->consultarUsuario($rfc, $contrasenia);
        
        if ($resultado == null) {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos, favor de verificar.';
            return null;
        } else {
            $_SESSION['usuario'] = $rfc;
            $_SESSION['nombre'] = $resultado->nombres . ' ' . $resultado->apellidoP . ' ' . $resultado->apellidoM;
            $_SESSION['rol'] = $resultado->idRol;
            return $resultado;
        }
    }
    function buscarUsuarios() {
        $mdlUsuario = new mdlUsuario();
        $rs = $mdlUsuario->consultarUsuarios();
        return $rs;
    }
    
}

?>