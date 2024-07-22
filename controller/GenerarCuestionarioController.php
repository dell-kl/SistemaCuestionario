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
                        header("Location: ?accion=opciones&estado=exito");   
                        return;
                    } 
                }

                header("Location: ?accion=opciones&estado=error");
            } catch (\Throwable $th) {
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

        public function RetornarUltimoRespuestaRegistrada()
        {
            $sql = "SELECT respuestasCues_id FROM RespuestasCues ORDER BY respuestasCues_id DESC LIMIT 1";
            $cn = $this->conn->prepare($sql);
            $cn->execute();
            $id = $cn->fetch();
            return $id["respuestasCues_id"];
        }

        public function RegistrarRespuestaCues(int $id, array $res, $r_correcto)
        {
            try {
                //code...
                $sql = "INSERT INTO RespuestasCues(respuestasCues_nombre,preguntasCues,respuestasCues_correcta) VALUES(?, ?, ?)";
                $cn = $this->conn->prepare($sql);
                $cn->bindValue(1, array_values($res)[0]);
                $cn->bindValue(2, $id);
                
                if ( array_keys($res)[0] === $r_correcto ) {                    
                    $cn->bindValue(3, 1);
                }
                else 
                {
                    $cn->bindValue(3, 0);
                }
                $cn->execute();
                
                $resultado = $this->RetornarUltimoRespuestaRegistrada();

                return $resultado;
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }
        }

        public function RegsitrarRespuestaCues(int $id, array $res, $r_correcto)
        {
            try {
                //code...
                $sql = "INSERT INTO RespuestasCues(respuestasCues_nombre,preguntasCues,respuestasCues_correcta)";
                
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
                        //con esto verificamos la respuesta que coincida con nuestra 
                        //r_correcto para poder darle una  respusta correcta. 
                        
                        if ( preg_match("/^$r$/", $r_correcto) )
                            $params[] = 1;
                        else
                            $params[] = 0;
                        
                    }
                }

                $sql .= implode(",", $valores);
                $consulta = $this->conn->prepare($sql);
                $consulta->execute($params);
                $resultado = $consulta->fetchAll();
                
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }

    }
?>