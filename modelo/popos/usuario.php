<?php

class Usuario {

    public $rfc;
    public $contrasenia;
    public $apellidoP;
    public $apellidoM;
    public $nombres;
    public $razonSocial;
    public $email;
    public $telefono;
    public $idRol;

    public function __construct($rfc, $contrasenia, $apellidoP, $apellidoM, $nombres, $razonSocial, $email, $telefono, $idRol) {
        $this->rfc = $rfc;
        $this->contrasenia = $contrasenia;
        $this->apellidoP = $apellidoP;
        $this->apellidoM = $apellidoM;
        $this->nombres = $nombres;
        $this->razonSocial = $razonSocial;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->idRol = $idRol;
    }

}

?>
