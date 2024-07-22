<?php
    /**
     * Este metodo de aqui tiene el proposito de verificar si en nuestro $_POST
     * encontramos claves o key qu contengan o inicien con responsable_ y al final tengan un numero
     */
    function filtrarPorResponsable($entrada) // -> nuestra entrada va a ser el $_POST 
    {   
        $filtrado = array_filter($entrada, function($key, $valor) {
              
            if( preg_match("/^responsable_[0-9]*$/", $valor) )
            {
                return $key;
            }

        }, ARRAY_FILTER_USE_BOTH);

        return $filtrado;
    }

    function filtrarPorResponsableAsignacion($entrada) // -> nuestra entrada va a ser el $_POST 
    {   
        $filtrado = array_filter($entrada, function($key, $valor) {
              
            if( preg_match("/^responsable_[0-9]*(_asignacion)/", $valor) )
            {
                return $key;
            }

        }, ARRAY_FILTER_USE_BOTH);

        return $filtrado;
    }
?>