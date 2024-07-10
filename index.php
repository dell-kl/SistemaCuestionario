<?php
    require_once("./config/db.php");
    require_once("./controller/FormularioController.php");
    require_once("./controller/GenerarCuestionarioController.php");
    require_once("./controller/CuestionariosController.php");

    $formularioController = new FormularioController($conexion);
    $cuestionarioController = new GenerarCuestionarioController($conexion);
    $CuesController = new CuestionariosController($conexion);

    if ( isset($_GET['accion']) )
    {
        $accion = $_GET['accion'];

        switch($accion)
        {
            case "formulario":
                $tipo = $_GET['tipoFormulario'];

                $formularioController->listarFormulario($tipo);
                break;

            case "opciones":
                $CuesController->obtenerTipoCuestionarios();
                break;

            
            case "eliminarCuestionario":
                if ( isset($_GET["id"]) )
                {
                    $id = $_GET["id"];
                    $CuesController->eliminarCuestionario($id);
                }
                else 
                {
                    header("Location: ?accion=opciones");
                }
                break;

            case "registrarCuestionario":
                
                if (  $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    //buscamos por medio de expresion regular
                    $listadoNuevo = array_filter($_POST, function($key, $valor) {
              
                        if( preg_match("/^pregunta_[0-9]{1,1}$/", $valor) )
                        {
                            return $key;
                        }
                    }, ARRAY_FILTER_USE_BOTH);

                    //registramos solo por una vez a nuestro tema del cuestionario....
                    $cuestionarioController->RegistrarTema($_POST["NTemaCuestionario"]);
                    $idTema = $cuestionarioController->ObtenerUltimoIdTema();

                    foreach($listadoNuevo as $keyp=>$valorp)
                    {
                        $listadoPreguntas = array_filter($_POST, function($valor, $key) {
                            global $keyp;

                            if ( preg_match("/^$keyp(_respuesta)/", $key) )
                            {
                                return $valor;
                            }
                        },ARRAY_FILTER_USE_BOTH);

                        //con este codigo vamos a registrar en la base de datos las respuestas y las preguntas...
                        $cuestionarioController->RegistrarCuestionario($idTema, $valorp, $listadoPreguntas);
                    }
                }

                break;

            case "registarRespuestas":
                $tipo = $_GET["tipoFormulario"];

                if ( $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    
                }

                break;

            case "generarCuestionario":
                require_once("./views/generar/CrearCuestionario.php");
                break;
        }
    }
?>