<?php

    class CuestionarioFinal 
    {
        public $tipoCues_id;
        public $tipoCues_tema;
        public $preguntasCues_id;
        public $preguntasCues_nombre;
        public RespuestasCues $respuestas;

        public function __construct($tipoCues_id, $tipoCues_tema, $preguntasCues_id, $preguntasCues_nombre, RespuestasCues $respuestas )
        {
            $this->tipoCues_id = $tipoCues_id;
            $this->tipoCues_tema = $tipoCues_tema;
            $this->preguntasCues_id = $preguntasCues_id;
            $this->preguntasCues_nombre = $preguntasCues_nombre;
            $this->respuestas = $respuestas;
        }
    }
?>