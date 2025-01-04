<?php
session_start();

class CerrarSesion {

    public function __construct() {
        $this->cerrar();
    }

    // Método para cerrar sesión
    public function cerrar() {
        // Destruir todas las variables de sesión
        session_unset();

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario al login o página principal
        header('Location: http://localhost/papeleria-cliente/index.php');  // Cambia esto a la página que desees
        exit();
    }
}

// Crear una instancia de la clase CerrarSesion
$cerrarSesion = new CerrarSesion();

?>