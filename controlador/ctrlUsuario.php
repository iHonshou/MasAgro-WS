<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include_once './modelo/mdlUsuario.php';
include_once './modelo/popos/usuario.php'; 

class ctrlUsuarios {

    // Función para validar un usuario
    function validarUsuario($usuario, $contrasenia) {
        $mdlUsuario = new mdlUsuario();
        $resultado = $mdlUsuario->consultarUsuario($usuario, $contrasenia);
        
        if ($resultado == null) {
            $_SESSION['error'] = 'Usuario o contraseña incorrectos, favor de verificar.';
            echo "<script type='text/javascript'>
                    alert('Usuario o contraseña incorrectos, favor de verificar.');
                    window.location.href = 'http://localhost/papeleria-cliente/index.php';
                  </script>";
            exit();
        } else {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $resultado['tipo'];
            if ($resultado['tipo'] == 'administrador') {
                header('Location: http://localhost/papeleria-cliente/inicio.php');
                exit();
            } else {
                header('Location: http://localhost/papeleria-cliente/inicio.php');
                exit();
            }
        }
        
    }

    // Función para obtener todos los usuarios registrados
    function buscarUsuarios() {
        $mdlUsuario = new mdlUsuario();
        $rs = $mdlUsuario->consultarUsuarios();
        return $rs;
    }
    
}

?>