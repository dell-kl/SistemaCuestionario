<?php
    require_once("./config/db.php");
    require_once("./model/Usuario.php");
    require_once("./controller/FormularioController.php");
    require_once("./controller/GenerarCuestionarioController.php");
    require_once("./controller/CuestionariosController.php");
    require_once("./controller/InicioSesionController.php");

    $formularioController = new FormularioController($conexion);
    $cuestionarioController = new GenerarCuestionarioController($conexion);
    $CuesController = new CuestionariosController($conexion);
    $loginController = new InicioSesionController($conexion);

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

            case "actualizarFormulario":
                
                if (  $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    /*
                    * hay varios a tomar en cuenta por ejemplo, de que el usuario haya eliminado algunas respuestas que ya no desea... en ese caso
                    * tendremos que verificar por esa respuesta eliminada.

                    * Tambien tenemos la otra opcion de que se hayan incluido unas nuevas preguntas y respuestas a nuestro cuestionario.
                    * Asi que eso debemos tambien ver la manera de como podemos capturar para poder procesarlos correctamente.
                    */
                    $indicePreguntaCuestionario = 0;
                    array_filter($_POST, function($value,$key) {
                        global $indicePreguntaCuestionario;
                        if ( preg_match("/^preguntaCuestionario/", $key) )
                        {
                            $indicePreguntaCuestionario = intval($value);
                        }
                    },ARRAY_FILTER_USE_BOTH);
                    
                    //vamos a traernos los id de las respuestas en base al id de la pregunta...
                    $registroIndices = $CuesController->obtenerIdRespuestas($indicePreguntaCuestionario);
                   
                    //despues tenemos que hacer una verificacion de cual dato ya no se encuentra para poder hacer la eliminacion.
                    $listadoNIndicesRespuestas = [];
                    array_filter($_POST, function($value,$key) { 
                        global $listadoNIndicesRespuestas;

                        if ( preg_match("/^respuestasCuestionario_/", $key) )
                        {
                            $listadoNIndicesRespuestas[] = intval($value);
                        }
                    }, ARRAY_FILTER_USE_BOTH);
  
                    echo "<pre>";
                    var_dump($_POST);
                    var_dump($listadoNIndicesRespuestas);
                    echo "</pre>";

                    //esta lista corresponde a las respuestas que fueron eliminadas en la parte de la interfaz... ahora lo que tenemos que hacer
                    //es una eliminacion completa en la base de datos de dicha respuestas....
                    $respuesta = array_diff($registroIndices, $listadoNIndicesRespuestas);
                    
                    if ( !empty($respuesta) )
                    {
                        foreach($respuesta as $v)
                        {
                            $respuestaEliminacion = $CuesController->eliminarRespuesta($v);
    
                            if ( !$respuestaEliminacion )
                                break;
                        }

                    }    

                    // header("Location: ?accion=opciones");
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
                        $listadoRespuestas = array_filter($_POST, function($valor, $key) {
                            global $keyp;

                            if ( preg_match("/^$keyp(_respuesta)/", $key) )
                            {
                                return $valor;
                            }
                        },ARRAY_FILTER_USE_BOTH);


                        $r_correcto = null;                        
                        array_filter($listadoRespuestas, function($key, $valor) {
                            global $r_correcto;
                            if( preg_match("/_correcta$/", $valor) )
                            {
                                $keyRespuestaON = explode("_correcta", $valor)[0];
                                $r_correcto = $keyRespuestaON;
                            
                            }
                        }, ARRAY_FILTER_USE_BOTH);

                        //con este codigo vamos a registrar en la base de datos las respuestas y las preguntas...
                        $cuestionarioController->RegistrarCuestionario($idTema, $valorp, $listadoRespuestas, $r_correcto);
                    }
                }

                break;

            case "registarRespuestas":
                $tipo = $_GET["tipoFormulario"];

                break;

            case "generarCuestionario":
                require_once("./views/generar/CrearCuestionario.php");
                break;

            case "sesion":
                require_once("./views/login/inicio_sesion.php");
                break;
            
            case "registro":
                require_once("./views/login/registrar.php");
                break;

            case "registroValidar":
                if ( $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    $usuario = new Usuario(
                        0,
                        $_POST["Nombre"],
                        $_POST["Apellido"],
                        $_POST["Email"],
                        $_POST["Password"],
                        2 //este de aqui es para perfil de profesorado.
                    );

                    $loginController->RegistrarValidar($usuario);
                }
                break;  

            case "sesionValidar":

                if ( $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    $email = $_POST["Email"];
                    $pass = $_POST["Password"];
                    $loginController->InicioSesionValidar($email, $pass);
                }
                break;

            case "perfilAdministrador":
                require_once("./views/perfiles/admin/admin.php");
                break;

            case "perfilProfesorado":
                require_once("./views/perfiles/profesor/profesorado.php");
                break;
        }
    }
?>