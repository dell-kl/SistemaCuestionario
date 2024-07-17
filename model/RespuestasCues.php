<?php

    class RespuestasCues
    {
        public $respuestasCues_id;
        public $respuestasCues_nombre;
        public $respuestasCues_correcta;
        public $preguntasCues;

        public function __construct(
            $respuestasCues_id, 
            $respuestasCues_nombre,
            $respuestasCues_correcta, 
            $preguntasCues
        )
        {
            $this->respuestasCues_id = $respuestasCues_id;
            $this->respuestasCues_nombre = $respuestasCues_nombre;
            $this->respuestasCues_correcta = $respuestasCues_correcta;
            $this->preguntasCues = $preguntasCues;
        }

    }
?>  