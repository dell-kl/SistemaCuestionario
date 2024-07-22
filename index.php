<?php
    require_once("./config/db.php");
    require_once("./model/Usuario.php");
    require_once("./model/AsignacionCuestionarioFinal.php");
    require_once("./controller/FormularioController.php");
    require_once("./controller/GenerarCuestionarioController.php");
    require_once("./controller/CuestionariosController.php");
    require_once("./controller/InicioSesionController.php");
    require_once("./controller/UsuariosController.php");
    require_once("./controller/AsignacionCuestionarioController.php");
    require_once("./tools/toolsFunc.php");
    require_once("./tools/gestionarCues.php");
    require_once("./tools/gestionarAsign.php");

    $formularioController = new FormularioController($conexion);
    $cuestionarioController = new GenerarCuestionarioController($conexion);
    $CuesController = new CuestionariosController($conexion);
    $loginController = new InicioSesionController($conexion);
    $usuariosController = new UsuariosController($conexion);
    $asignacionCuestionarioController = new AsignacionCuestionarioController($conexion);

    
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

            case "asignarCuestionario":
                $res = $usuariosController->obtenerUsuarios();
                $cues = $CuesController->obtenerDatosCuestionarios();
                require_once("./views/generar/AsignarCuestionarios.php");
                break;
            
            case "generarAsignacionUsuario":
                if ( $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    $resultado = filtrarPorResponsableAsignacion($_POST);
                    debuguear($resultado);

                    $asignacionCuestionario = new AsignacionCuestionarioFinal("", "", "");
                    $asignacionCuestionarioController->asignarCuestionarioUsuarios($asignacionCuestionario);
                }

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
                    //formatear nuestro $_POST para generar matrices anidadas.
                    $posicionPreguntas = filtrarPosicionesPreguntas($_POST);
                    
                    //retornando nueva lista de valores con los datos....
                    $nuevolistado = nuevaListaDatosCuestionario($posicionPreguntas, $_POST); 
                    
                    //verificar por cada pregunta matriz si se encuentra una nueva respuesta a la pregunta. 
                    filtrarPorRespuestasNuevasPreguntas($nuevolistado);

                    //Este metodo de aqui se va a encargar mas bien de registrar si exsite una nueva pregunta con respuestas .... 
                    verificarPreguntasRespuestasNuevas($_POST);
            
                    header("Location: ?accion=opciones");
                }

                break;

            case "registrarCuestionario":
                
                if (  $_SERVER["REQUEST_METHOD"] === "POST" )
                {
                    //buscamos por medio de expresion regular
                    $listadoNuevo = filtrarPorPregunta($_POST); 

                    //registramos solo por una vez a nuestro tema del cuestionario....
                    $cuestionarioController->RegistrarTema($_POST["NTemaCuestionario"]);
                    
                    $idTema = $cuestionarioController->ObtenerUltimoIdTema();
                    
                    foreach($listadoNuevo as $keyp=>$valorp)
                    {
                        global $keyp;

                        $listadoRespuestas = filtrarPorRespuestaCaracter($_POST, $keyp);
                        $r_correcto = filtrarPorRespuestaCorrectaCaracter($listadoRespuestas);
                           
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