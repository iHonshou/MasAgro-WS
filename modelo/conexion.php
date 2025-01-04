<?php

class Conexion {

    private $cnx;
    function conectar() {
        $usuario = 'root';
        $contrasenia = 'Kasacuas90.';
        try {
            $this->cnx = new PDO('mysql:host=127.0.0.1;dbname=MasAgro', 
                    $usuario, $contrasenia);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }        
        return $this->cnx;
    }

    function desconectar() {
        $this->cnx = null;
    }

}

?>