<?php

    class UsuariosController 
    {
        private $conn;
        public function __construct($conexion)
        {
            $this->conn = $conexion;
        }

        public function obtenerUsuarios()
        {
            $sql = "SELECT u.usuario_id, u.usuario_nombre, u.usuario_apellido, u.usuario_email, r.rol_nombre FROM Usuario AS u INNER JOIN Rol as r ON u.usuario_rolId = r.rol_id WHERE r.rol_nombre != 'administrador' AND r.rol_nombre != 'admin'";
            $consul = $this->conn->prepare($sql);
            $consul->execute();
            $res = $consul->fetchAll();
            
            return $res;
        }
    }
?>