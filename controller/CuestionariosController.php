<?php
    require_once("./model/RespuestasCues.php");
    require_once("./model/CuestionarioFinal.php");

    class CuestionariosController
    {
        private $conn;

        public function __construct($conexion)
        {
            $this->conn = $conexion;
        }

        public function obtenerTipoCuestionarios()
        {
            $sql = "SELECT tipoCues_id, tipoCues_tema FROM TipoCuestionario";
            $conexion = $this->conn->prepare($sql);
            $conexion->execute();
            $resultado = $conexion->fetchAll();

            $dataCuestionarios = $this->obtenerInformacionCuestionarios();

            require_once("./views/VistaOpciones.php");
        }

        public function eliminarCuestionario($id)
        {
            $sql = "DELETE FROM TipoCuestionario WHERE tipoCues_id = ?";
            $conexion = $this->conn->prepare($sql);
            $conexion->bindValue(1, $id);
            $conexion->execute();

            header("Location: ?accion=opciones");
        }

        public function actualizarCuestionario()
        {
            
        }

        public function obtenerInformacionCuestionarios()
        {
            $sql = "SELECT tipoCues_id, tipoCues_tema, preguntasCues_id, preguntasCues_nombre, respuestasCues_id, respuestasCues_nombre FROM TipoCuestionario AS TC INNER JOIN PreguntasCues AS PC ON TC.tipoCues_id = PC.preguntasTipoCues INNER JOIN RespuestasCues AS RC ON PC.preguntasCues_id = RC.preguntasCues";
            $conexion = $this->conn->prepare($sql);
            $conexion->execute();
            $resultado = $conexion->fetchAll();

            $registro = [];
            foreach($resultado as $res)
            {
                $cuest = new CuestionarioFinal(
                    $res["tipoCues_id"],
                    $res["tipoCues_tema"],
                    $res["preguntasCues_id"],
                    $res["preguntasCues_nombre"],
                    new RespuestasCues(
                        $res["respuestasCues_id"],
                        $res["respuestasCues_nombre"],
                        0,
                    )
                );
                $registro[] = $cuest;
            }

            return $registro;
        }
    }
?>