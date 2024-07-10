<?php

    class CuestionarioFinal 
    {
        public $tipoCues_id;
        public $tipoCues_tema;
        public $preguntasCues;
        public array $respuestas;

        public function __construct($tipoCues_id, $tipoCues_tema, $preguntasCues, array $respuestas )
        {
            $this->tipoCues_id = $tipoCues_id;
            $this->tipoCues_tema = $tipoCues_tema;
            $this->preguntasCues = $preguntasCues;
            $this->respuestas = $respuestas;
        }
    }
?>