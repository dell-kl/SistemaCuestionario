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
            debuguear($asignacion);
            try {
                //code...   
                $sql = "INSERT INTO AsignacionCuestionarioFinal(asig_tipoCuestionarioId, asig_usuarioId) VALUES(?, ?)";
                $cn = $this->conn->prepare($sql);
                $cn->bindValue(1, $asignacion->asig_tipoCuestinoarioId);
                $cn->bindValue(2, $asignacion->asig_usuarioId);
                $cn->execute();
                return true;
            } catch (\Throwable $th) {
                //throw $th;
                debuguear($th);
                return false;
            }

        }
    }
?>