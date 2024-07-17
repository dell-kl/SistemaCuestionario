<?php
    require_once("./model/RespuestasCues.php");
    require_once("./model/PreguntasCues.php");
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

        public function obtenerIdRespuestas(int $id)
        {
            $sql = "SELECT respuestasCues_id FROM RespuestasCues WHERE preguntasCues = ?";
            $conexion = $this->conn->prepare($sql);
            $conexion->bindValue(1, $id);
            $conexion->execute();
            $resultado = $conexion->fetchAll();
            
            $r = [];

            foreach($resultado as $key=>$value)
            {
                $r[] = intval($value["respuestasCues_id"]);
            }
            return $r;
        }

        public function eliminarRespuesta(int $idRespuesta)
        {
            try {
                //code...
                $sql = "DELETE FROM RespuestasCues WHERE respuestasCues_id = ?";
                $conexion = $this->conn->prepare($sql);
                $conexion->bindValue(1, $idRespuesta);
                $conexion->execute();

                return true;
            } catch (\Throwable $th) {
                
                //throw $th;
                return false;
            }
        }

        public function obtenerInformacionCuestionarios()
        {
            try {
                //code...
                $sql = "SELECT tipoCues_id, tipoCues_tema, preguntasCues_id, preguntasCues_nombre, respuestasCues_id, respuestasCues_nombre, preguntasCues, respuestasCues_correcta FROM TipoCuestionario AS TC INNER JOIN PreguntasCues AS PC ON TC.tipoCues_id = PC.preguntasTipoCues INNER JOIN RespuestasCues AS RC ON PC.preguntasCues_id = RC.preguntasCues";
                $conexion = $this->conn->prepare($sql);
                $conexion->execute();
                $resultado = $conexion->fetchAll();
            } catch (\Throwable $th) {
                //throw $th;
                header("Location: ?accion=generarCuestionario&estado=error");
            }

            $cuest = new CuestionarioFinal(
                $resultado[0]["tipoCues_id"],
                $resultado[0]["tipoCues_tema"],
                [],
                []
            );

            foreach($resultado as $res)
            {
                $pregunta = new PreguntasCues(
                    $res["preguntasCues_id"],
                    $res["preguntasCues_nombre"],
                    $res["tipoCues_id"]
                );

                if (  count($cuest->preguntasCues) === 0 )
                {
                    $cuest->preguntasCues[] = $pregunta;
                }
                else 
                {
                    $arg = array_column($cuest->preguntasCues, "preguntasCues_id" );
                    $nIndice = $arg[count($arg)-1];
                    
                    if ( !( $nIndice === $pregunta->preguntasCues_id ) )
                    {
                        // var_dump($pregunta->preguntasCues_nombre);
                        $cuest->preguntasCues[] = $pregunta;
                    }
                }

                $cuest->respuestas[] = new RespuestasCues(
                    $res["respuestasCues_id"],
                    $res["respuestasCues_nombre"],
                    $res["respuestasCues_correcta"],
                    $res["preguntasCues"]
                );
            }

            return $cuest;
        }
    }
?>