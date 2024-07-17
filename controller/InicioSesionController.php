<?php

    class InicioSesionController
    {
        private $conn;

        public function __construct($conexion)
        {
            $this->conn = $conexion;
        }

        public function InicioSesionValidar($email, $pass)
        {
            
            $sql = "SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_email, usuario_password, usuario_rolId FROM Usuario WHERE usuario_email = ?";
            $consulta = $this->conn->prepare($sql);
            $consulta->bindValue(1, $email);
            $consulta->execute();

            $resultado = $consulta->fetchAll();
         
            if ( empty($resultado) )
            {
                header("Location: ?accion=sesion&estado=error");
            }
            else 
            {
                // $this->validarPorRol($resultado)
                $this->validarPorRol($resultado[0], $pass);
            }
        }

        public function RegistrarValidar(Usuario $usuario)
        {
            try {
                //encriptar password
                $encriptarPassword = password_hash($usuario->usuario_password, PASSWORD_DEFAULT);

                //code...
                $sql = "INSERT INTO Usuario(usuario_nombre, usuario_apellido, usuario_email, usuario_password, usuario_rolId) VALUES(?, ?, ?, ?, ?)";
                $consulta = $this->conn->prepare($sql);
                $consulta->bindValue(1, $usuario->usuario_nombre);
                $consulta->bindValue(2, $usuario->usuario_apellido);
                $consulta->bindValue(3, $usuario->usuario_email);
                $consulta->bindValue(4, $encriptarPassword);
                $consulta->bindValue(5, $usuario->usuario_rolId);
                $consulta->execute();
                header("Location: ?accion=sesion&estado=correcto");
            } catch (\Throwable $th) {
                //throw $th;
                header("Location: ?accion=registro&estado=error");
            }
        }

        public function validarPorRol($dato, $pass)
        {
            
            if (password_verify($pass, $dato["usuario_password"])) {
                
                if ( $dato["usuario_rolId"] === 1 )
                {
                    header("Location: ?accion=perfilAdministrador");
                }
                else 
                {
                    header("Location: ?accion=perfilProfesorado");
                }

                return;
            } 

            header("Location: ?accion=sesion&estado=error");
        }
    }
?>