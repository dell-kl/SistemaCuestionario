<?php
    class PreguntasCues 
    {
        public $preguntasCues_id;
        public $preguntasCues_nombre;
        public $preguntasTipoCues;

        
        public function __construct($preguntasCues_id, $preguntasCues_nombre, $preguntasTipoCues)
        {
            $this->preguntasCues_id = $preguntasCues_id;
            $this->preguntasCues_nombre = $preguntasCues_nombre;
            $this->preguntasTipoCues = $preguntasTipoCues;
        }

    }
?>