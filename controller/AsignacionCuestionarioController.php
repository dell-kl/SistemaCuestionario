<?php

    

    class AsignacionCuestionarioController 
    {
        private $conn;

        public function __construct($conexion)
        {
            $this->conn = $conexion;
        }

        public function asignarCuestionarioUsuarios(AsignacionCuestionarioFinal $asignacion)
        {
            $sql = "";
        }
    }
?>