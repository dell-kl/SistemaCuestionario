<?php
    require_once("./controller/GenerarCuestionarioController.php");
    require_once("./controller/CuestionariosController.php");

    $cuestionarioController = new GenerarCuestionarioController($conexion);
    $CuesController = new CuestionariosController($conexion);
    /**
     * Las funciones a continuacion son una herramienta que permitiran filtrar la informacion encontrada
     * dentro del metodo POST o $_POST["ejemplo"] ... nos resultara mucho mas facil para programar procesos
     * ....
     */
    function debuguear($entrada)
    {
        echo "<pre>";
        var_dump($entrada);
        echo "</pre>";
        return;
    }


    /**
     * Este metodo de aqui tiene el proposito de verificar si en nuestro $_POST["ejemplo"]
     * encontramos claves o key qu contengan o inicien con pregunta_ y al final tengan un numero
     */
    function filtrarPorPregunta($entrada) // -> nuestra entrada va a ser el $_POST 
    {   
        $filtrado = array_filter($entrada, function($key, $valor) {
              
            if( preg_match("/^pregunta_[0-9]*$/", $valor) )
            {
                return $key;
            }

        }, ARRAY_FILTER_USE_BOTH);

        return $filtrado;
    }

    function filtrarPorRespuestaAdicional($entrada) // -> nuestra entrada va a ser el $_POST 
    {   
        $filtrado = array_filter($entrada, function($key, $valor) {
              
            if( preg_match("/^pregunta_[0-9]*(_respuesta)/", $valor) )
            {
                return $key;
            }

        }, ARRAY_FILTER_USE_BOTH);

        return $filtrado;
    }


    /*
    * hay varios a tomar en cuenta por ejemplo, 
    * de que el usuario haya eliminado algunas 
    * respuestas que ya no desea... en ese caso
    * tendremos que verificar por esa respuesta eliminada.
    * Tambien tenemos la otra opcion de que se hayan incluido 
    * unas nuevas preguntas y respuestas a nuestro cuestionario.
    * Asi que eso debemos tambien ver la manera de como podemos 
    * capturar para poder procesarlos correctamente.
    */
    function filtrarPorPreguntaIdentificador($post)
    {
        $res = array_filter($post, function($value,$key) {
            global $indicePreguntaCuestionario;
            if ( preg_match("/^preguntaCuestionario/", $key) )
            {
                $indicePreguntaCuestionario = intval($value);
                return $indicePreguntaCuestionario;
            }
        },ARRAY_FILTER_USE_BOTH);
        
        return array_values($res)[0];
    }


    /**
     * Con este metodo de aqui el proposito era acceder a las posiciones
     * que se encuentra nuestras "preguntaCuestionario" en el $_POST...
     * ya que mas adelante queremos formatear los datos ... 
     */
    function filtrarPosicionesPreguntas($post)
    {
        $res = array_keys( array_filter($post, function($value,$key) {
            global $indicePreguntaCuestionario;
            if ( preg_match("/^preguntaCuestionario/", $key) )
            {
                return $key;
            }
        },ARRAY_FILTER_USE_BOTH) );
        

        $indicesListado = array_map(function($value) use ($post) { 
            $i =  array_search($value, array_keys($post));
            return $i;
        }, $res);

        $indicesListado[] = count($post); // incluimos el conteo final de nuestra informacion.

        return $indicesListado; 
    }


    /**
     * Vamos hacer una verificaicon si en cada matriz,,, existe nuevas respuestas
     * de las preguntas....
     * ....
     * [
     *  [... datos de la pregunta y sus respuestas]
     * ]
     * Lo que esta arriba es el formato que realizamos al formatear con nuevaListaDatosCuestionario() que esta en el archivo gestionarCues.php
     * 
     */
    function filtrarPorRespuestasNuevasPreguntas($post)
    {
        global $cuestionarioController, $CuesController, $conexion;

        foreach($post as $value)
        {
            //esta variable de aqui se saca la clave de aquella respuesta hasido seleccionada como correcta en el formulario
            $respuestaCorrecta = filtrarPorRespuestaCorrectaCaracter($value);
            
            //sacamos el indice de nuestra pregunta porque va a ser necesario en el registro de nuestras nuevas respuestas de la pregunta...
            $indicePregunta = array_values($value)[0];     
            
            //verificamos si en las preguntas de los formularios incluimos respuestas adicionales.
            $resultado = filtrarPorRespuestaAdicional($value);

            $IdRespuestasNuevasRegistradas = [];
            if ( !empty(array_values($resultado)) )
            {
                if ( count($resultado) === 1 )
                    //vamos a insertar esa respuesta
                    $IdRespuestasNuevasRegistradas[] = $cuestionarioController->RegistrarRespuestaCues($indicePregunta, $resultado, $respuestaCorrecta);
                else 
                    foreach($resultado as $k=>$v)
                    {
                        //si este es el caso vamos a tener que recorre para que nos vaya tratendo cada uno de nuestros id... 
                        $IdRespuestasNuevasRegistradas[] = $cuestionarioController->RegistrarRespuestaCues($indicePregunta, array($k => $v), $respuestaCorrecta);
                    }
            }
            
            //vamos a traernos los id de las respuestas en base al id de la pregunta...
            $registroIndices = $CuesController->obtenerIdRespuestas($indicePregunta);
            
            //vamos a realizar la eliminacion de las respuestas no encontradas en el cuestionario....
            verificarRespuestasEliminadas($value, $registroIndices, $IdRespuestasNuevasRegistradas);
        }   
    }



    /**
     * Este metodo se va a encargar de verificar si en nuestro $_POST["ejemplo"]
     * encontramos claves o key que contengan por la mitad de su caracter el : _respuesta
     * ejemplo:
     *  pregunata_1_respuesta <- finaliza con _respuesta...
     * Esto sirve para verificar quienen son la respuesta de que pregunta...
     */
    function filtrarPorRespuestaCaracter($entrada, $entrada2) // entrada uno lo que vamos analizar y entrada2 con lo que vamos a comparar
    {
        $filtrado = array_filter($entrada, function($valor, $key) use ($entrada2) {
       
            if ( preg_match("/^$entrada2(_respuesta)/", $key) )
            {
                return $valor;
            }
        },ARRAY_FILTER_USE_BOTH);
        
        return $filtrado;
    }


    /**
     * Este metodo se va a encargar de verificar si en nuestra cadene que es la llave de nuestro $_POST
     * se encuentra uno que contenga el caracter "_correcta al final... 
     */
    function filtrarPorRespuestaCorrectaCaracter($entrada)
    {
        $r_correcto = array_filter($entrada, function($key, $valor) {
            
            if( preg_match("/(_correcta)$/", $valor) )
            {
                $keyRespuestaON = explode("_correcta", $valor)[0];
                return $keyRespuestaON;
            }
        }, ARRAY_FILTER_USE_BOTH);
        
        return str_replace('_correcta', '', array_keys($r_correcto)[0]);
    }
    
?>