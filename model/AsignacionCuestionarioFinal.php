<?php

    class AsignacionCuestionarioFinal
    {
        public $asig_id;
        public $asig_tipoCuestinoarioId;
        public $asig_usuarioId;

        public function __construct($asig_id, $asig_tipoCuestinoarioId, $asig_usuarioId)
        {
            $this->asig_id = $asig_id;
            $this->asig_tipoCuestinoarioId = $asig_tipoCuestinoarioId;
            $this->asig_usuarioId = $asig_usuarioId;
        }   
    }
?>