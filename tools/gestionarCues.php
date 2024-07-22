<?php
    require_once('./tools/toolsFunc.php');
    require_once("./controller/CuestionariosController.php");
    require_once("./controller/GenerarCuestionarioController.php");

    $CuesController = new CuestionariosController($conexion);
    $cuestionarioController = new GenerarCuestionarioController($conexion);
    /**
     * Estos metodos de aqui nos van a 
     * servir para poder gestionar ciertas partes de la funcionalidad
     * de nuestro cuestionario...
     */


    //eliminacion de respuestas ya no encontradas dentro de nuestro formulario.
    function verificarRespuestasEliminadas($post, $registroIndices, $idRespuestasNuevasRegistradas)
    {
        global $CuesController;

        $listadoNIndicesRespuestas = array_filter($post, function($value,$key)  {
            global $listadoNIndicesRespuestas;
            if ( preg_match("/^respuestasCuestionario_/", $key) )
            {
                return intval($value);
            }
        }, ARRAY_FILTER_USE_BOTH);

        //junstamos los id recien registrados y los que ya estaban en el formulario... 
        $listadoNIndicesRespuestas = array_merge($listadoNIndicesRespuestas, $idRespuestasNuevasRegistradas); 

        $listadoNIndicesRespuestas = array_values($listadoNIndicesRespuestas);
        //esta lista corresponde a las respuestas que fueron eliminadas en la parte de la interfaz... ahora lo que tenemos que hacer
        //es una eliminacion completa en la base de datos de dicha respuestas....
        $respuesta = array_diff($registroIndices, $listadoNIndicesRespuestas);
        
        if ( !empty($respuesta) )
        {
            foreach($respuesta as $v)
            {
                $respuestaEliminacion = $CuesController->eliminarRespuesta($v);
            }
        }   
    }   



    function verificarPreguntasRespuestasNuevas($post)
    {
        global $cuestionarioController;

        //encontramos primero las preguntasNuevas
        $listadoPreguntasNuevas = filtrarPorPregunta($post);

        if ( !empty($listadoPreguntasNuevas) )
        {
            //tomamos el Id del tipo de Cuestionario
            $idTipoCuestionario = intval($post["tipoCuestionarioId"]);
            
            //vamos registraando las preguntas.
            foreach($listadoPreguntasNuevas as $kPreg=>$vPreg)
            {
                $listadoRespuestas = filtrarPorRespuestaCaracter($post, $kPreg);
                $r_correcto = filtrarPorRespuestaCorrectaCaracter($listadoRespuestas);
                
                //ahora en esta parte final volvemos a registrar
                $cuestionarioController->RegistrarCuestionario($idTipoCuestionario, $vPreg, $listadoRespuestas, $r_correcto);
            }
        }
    }



    function nuevaListaDatosCuestionario(array $posiciones, $post)
    {
        $i = 0;
        $f = 1;

        $info = [];
        while(true)
        {    
            if ( $i === $f )
               $f+=1;
        
            $posicionInicial = $posiciones[$i];
            $posicionaFinal = $posiciones[$f];

            //traer la longitud de los elementos hasta la posicion final.
            $l = 0;
            for($j=$posicionInicial;$j<$posicionaFinal;$j++)
                $l+=1;
                
            $subDatos = array_slice($post, $posicionInicial, $l);
            $info[] = $subDatos;

            if ( count($posiciones)-1 === $f ) 
                break;

            $i+=1;  
        }

        return $info;
    }

?>