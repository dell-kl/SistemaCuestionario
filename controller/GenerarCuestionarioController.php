<?php

    class GenerarCuestionarioController 
    {

        private $conn;

        public function __construct($conexion)
        {
            $this->conn = $conexion;
        }

        public function RegistrarCuestionario($id, $pregunta, array $respuestas, $r_correcto)
        {
            try {             
                $resultado = $this->RegistrarPreguntaCues($pregunta, $id);
                
                if ( $resultado )
                {
                    $idPregunta = $this->ObtenerUltimoIdPregunta();
                   
                    $resultado = $this->RegsitrarRespuestaCues($idPregunta, $respuestas, $r_correcto);
    
                    if( $resultado )
                    {
                        header("Location: ?accion=opciones");
                        return;
                    } 
                }

                header("Location: ?accion=generarCuestionario");
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }
        }

        public function RegistrarTema($tema)
        {
            $sql = "INSERT INTO TipoCuestionario(tipoCues_tema) VALUES(?)";
            $consulta = $this->conn->prepare($sql);
            $consulta->bindValue(1, $tema);
            $consulta->execute();
        }

        public function ObtenerUltimoIdTema()   
        {
            $sql = "SELECT tipoCues_id FROM TipoCuestionario ORDER BY tipoCues_id DESC LIMIT 1";
            $consulta = $this->conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();

            return $resultado[0]["tipoCues_id"];
        }

        public function ObtenerUltimoIdPregunta()
        {
            $sql = "SELECT preguntasCues_id FROM PreguntasCues ORDER BY preguntasCues_id DESC LIMIT 1";
            $consulta = $this->conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();

            return $resultado[0]["preguntasCues_id"];
        }

        public function RegistrarPreguntaCues($pregunta, $id)
        {
            try {
                //code...
                $sql = "INSERT INTO PreguntasCues( preguntasCues_nombre, preguntasTipoCues ) VALUES( ?, ? )";
                $consulta = $this->conn->prepare($sql);
                $consulta->bindValue(1, $pregunta);
                $consulta->bindValue(2, $id);
                $consulta->execute();
                return true;
            } catch (\Throwable $th) {
                echo "<pre>";
                var_dump($th);
                echo "</pre>";
                //throw $th;
                return false;
            }
        }

        public function RegsitrarRespuestaCues($id, array $res, $r_correcto)
        {
            try {
                //code...
                $sql = "INSERT INTO RespuestasCues( respuestasCues_nombre, preguntasCues, respuestasCues_correcta)";
                
                $i = 0;
                $valores = [];
                $params = [];
                
                foreach($res as $r=>$v)
                {
                    if( !preg_match("/_correcta$/", $r) )
                    {
                        
                        $value = "";
                        if($i === 0)
                        {
                            $value = " VALUES( ?, ?, ? ) ";
                            $i+=1;
                        }
                        else 
                        {
                            $value = " ( ?, ?, ? ) "; 
                        }

                        $valores[] = $value;
                        $params[] = $v;
                        $params[] = $id;
                        $params[] = 0;

                        if ( $r === $r_correcto )
                        {
                            $params[2] = 1;
                        }
                        
                    }
                }
                
                $sql .= implode(",", $valores);
                $consulta = $this->conn->prepare($sql);
               
                $consulta->execute($params);

                return true;
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }
        }

    }
?>