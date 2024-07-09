<?php
    require_once("./model/PreguntasCues.php");

    class FormularioController {

        private $conn;

        public function __construct($conexion)
        {
            $this->conn = $conexion;
        }


        public function listarFormulario($tipo)
        {  
            $sql = "SELECT * FROM PreguntasCues WHERE preguntasTipoCues = $tipo";
            $consulta = $this->conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();

            $preguntas = [];

            foreach( $resultado as $r )
            {
                $c = new PreguntasCues(
                    $r["preguntasCues_id"],
                    $r["preguntasCues_nombre"],
                    $r["preguntasTipoCues"]
                );

                $preguntas[] = $c;
            }

            require_once("./views/Cuestionario.php");
        }


        public function RegistrarRespuesta()
        {

        }
    }
?>