<?php include_once __DIR__ . './../template/header.php'; ?>
        
        <div class="crearCuestionario">
            
            <?php include_once __DIR__ . './../template/sidebar.php'; ?>
                <div class="proceso">
                    <button type="button" id="asignarNombre" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-wrench-adjustable-circle-fill"></i>
                        Asignar Nombre
                    </button>
    
                    <form method="POST" action="?accion=registrarCuestionario">
                        <div class="mt-4 proceso_form">
                            <h2 class="fs-5 text-center p-2 tema">Tema Cuestionario: <span class="fw-light fs-5" id="nombreTema"><input id="TemaCuestionario" type="text" name="NTemaCuestionario" value="Sin Tema"></span></h2>
                            
                            <div class="botonFinalizar m-auto pb-3">        
                                <button type="button" id="agregarPregunta" class="btn btn-warning mt-2 d-inline mb-2">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    Agregar Pregunta
                                </button>
                                <button 
                                    type="submit"
                                    class="btn btn-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Finalizar Cuestionario
                                </button>
                            </div>
                            <div class="formulario">
                                <div class="pregunta_seccion">
                                    <div class="acciones d-flex align-items-center justify-content-between">
                                        <div>
                                            <button type="button" id="agregarRespuesta-1" class="btn btn-primary mt-2 d-inline mb-2 botonAgregarRespuesta">
                                                <i class="bi bi-plus-circle-fill"></i>
                                                Agregar Respuesta
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tabla ajustar-tabla">
                                        <div class="campo-pregunta">
                                            <label for="pregunta" class="fw-light pb-2">Ingresa tu pregunta</label>
                                            <input type="text" id="pregunta" name="pregunta_1" class="form-control" placeholder="Ingresa primera pregunta para el cuestionario">
                                        </div>
                                        <div class="campo-respuestas agregarRespuesta-1">
                                            <div class="campo campo_eIEaAEaAUuIOiUoAAEaiUuAIoIiuoa">
                                                <label for="respuesta1" class="fw-light pb-2">Ingresa tu respuesta</label>
                                                <div class="campo_seccion">
                                                    <input type="text" id="respuesta1" name="pregunta_1_respuesta_00001" class="form-control respuesta" placeholder="Ingresa la respuesta para la pregunta">                        
                                                    <button value="campo_eIEaAEaAUuIOiUoAAEaiUuAIoIiuoa" type="button" class="botonEliminarRespuesta"><i style="font-size:25px;color:red;" class="bi bi-x-circle-fill"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
           
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tema Cuestionario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="d-flex flex-column fw-light p-2">
                    Descripcion Cuestionario
                    <input type="text" id="descripcionTema" placeholder="Ingresa un nombre para tu cuestionario...">
                </p>
                <span class="mensajes"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarTemaCuestionario">Guardar</button>
            </div>
            </div>
        </div>
    </div>

<?php include_once __DIR__ . './../template/footer.php'; ?>