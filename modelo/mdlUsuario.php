<?php

session_start();

include_once 'Conexion.php';  // Clase de conexión
include_once 'popos/usuario.php';  // Incluye la clase de Usuario

class mdlUsuario {
    function consultarUsuario($rfc, $contrasenia)
    {
        $sql = 'SELECT rfc FROM Usuarios WHERE rfc = :rfc AND contrasenia = :contrasenia;';
        $cnx = new Conexion();
        $conexion = $cnx->conectar();
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(':rfc', $rfc);
        $stmt->bindValue(':contrasenia', $contrasenia);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cnx->desconectar();

        return $row;
    }

    function guardarUsuario($usuario)
    {
        $conexion = new Conexion();
        $db = $conexion->conectar();

        // Usamos el procedimiento almacenado para guardar el usuario
        $query = "CALL guardarUsuario(:rfc, :contrasenia, :apellidoP, :apellidoM, :nombres, :razonSocial, :e_mail, :telefono, :idRol)";
        $stmt = $db->prepare($query);
        
        // Asignar los valores del objeto Usuario a los parámetros del procedimiento almacenado
        $stmt->bindValue(':rfc', $usuario->getRfc());
        $stmt->bindValue(':contrasenia', $usuario->getContrasenia());
        $stmt->bindValue(':apellidoP', $usuario->getApellidoP());
        $stmt->bindValue(':apellidoM', $usuario->getApellidoM());
        $stmt->bindValue(':nombres', $usuario->getNombres());
        $stmt->bindValue(':razonSocial', $usuario->getRazonSocial());
        $stmt->bindValue(':e_mail', $usuario->getEmail());
        $stmt->bindValue(':telefono', $usuario->getTelefono());
        $stmt->bindValue(':idRol', $usuario->getIdRol());

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Usuario guardado exitosamente
        } else {
            return false; // Error al guardar el usuario
        }
    }
    
    // Función para consultar todos los usuarios
    public function consultarUsuarios() {
        $conexion = new Conexion();
        $db = $conexion->conectar();

        // Usamos el procedimiento almacenado para obtener los usuarios
        $query = "CALL consultarUsuarios()";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $usuarios = [];

        // Recuperar los usuarios y asignarlos al objeto Usuario
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Crear objeto Usuario usando el constructor con los parámetros necesarios
            $usuario = new Usuario(
                $row['rfc'],
                $row['contrasenia'],
                $row['apellidoP'],
                $row['apellidoM'],
                $row['nombres'],
                $row['razonSocial'],
                $row['e_mail'],
                $row['telefono'],
                $row['idRol']
            );
            $usuarios[] = $usuario;
        }

        $conexion->desconectar();

        return $usuarios;
    }
    
    public function consultarUsuarioPorRFC($rfc) {
        $conexion = new Conexion();
        $db = $conexion->conectar();
        $sql = "SELECT rfc, apellidoP, apellidoM, nombres, razonSocial, e_mail, telefono, idRol FROM Usuarios WHERE rfc = :rfc";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':rfc', $rfc);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $conexion->desconectar();
        return $usuario;
    }
}

?>
