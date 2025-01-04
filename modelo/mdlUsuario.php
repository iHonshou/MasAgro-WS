<?php
include_once 'Conexion.php';  // Clase de conexión
include_once 'popos/usuario.php';  // Incluye la clase de Usuario

class mdlUsuario {
    // Función para consultar un usuario por nombre de usuario y contraseña
    function consultarUsuario($usuario, $contrasenia)
    {
        $sql = 'SELECT * FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasenia;';
        $cnx = new Conexion();
        $conexion = $cnx->conectar();
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':contrasenia', $contrasenia);
        $stmt->execute();

        $rs = $stmt->fetch(PDO::FETCH_ASSOC);
        $cnx->desconectar();

        return $rs;
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
}

?>
