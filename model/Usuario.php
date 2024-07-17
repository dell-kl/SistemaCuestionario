<?php

    class Usuario 
    {
        public $usuario_id;
        public $usuario_nombre;
        public $usuario_apellido;
        public $usuario_email;
        public $usuario_password;
        public $usuario_rolId;


        public function __construct($usuario_id, $usuario_nombre, $usuario_apellido, $usuario_email, $usuario_password, $usuario_rolId)
        {
            $this->usuario_id = $usuario_id;
            $this->usuario_nombre = $usuario_nombre;
            $this->usuario_apellido = $usuario_apellido;
            $this->usuario_email = $usuario_email;
            $this->usuario_password = $usuario_password;
            $this->usuario_rolId = $usuario_rolId;
        }

    }
?>