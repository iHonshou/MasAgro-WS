<?php

include_once './modelo/mdlUsuario.php';
include_once './modelo/popos/usuario.php'; 

class ctrlUsuarios {

    function validarUsuario($rfc, $contrasenia) {
        $mdlUsuario = new mdlUsuario();
        $resultado = $mdlUsuario->consultarUsuario($rfc, $contrasenia);
        
        if ($resultado != null) {
            $_SESSION['usuario'] = $rfc;
            return $_SESSION;
        }
        return null;
    }
    function buscarUsuarios() {
        $mdlUsuario = new mdlUsuario();
        $rs = $mdlUsuario->consultarUsuarios();
        return $rs;
    }
    
}

?>