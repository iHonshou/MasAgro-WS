<?php
session_start();

class CerrarSesion {

    public function __construct() {
        $this->cerrar();
    }

    public function cerrar() {
        session_unset();

        session_destroy();
        header('Location: http://localhost/papeleria-cliente/index.php');
        exit();
    }
}

$cerrarSesion = new CerrarSesion();

?>