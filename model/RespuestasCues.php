<?php

    class RespuestasCues
    {
        public $respuestasCues_id;
        public $respuestasCues_nombre;
        public $preguntasCues;

        public function __construct($respuestasCues_id, $respuestasCues_nombre, $preguntasCues)
        {
            $this->respuestasCues_id = $respuestasCues_id;
            $this->respuestasCues_nombre = $respuestasCues_nombre;
            $this->preguntasCues = $preguntasCues;
        }

    }
?>  