<?php
    if ( isset($_GET["id"]) )
    { ?>
        <div class="modal" tabindex="-1" style="display:block;" data-bs-backdrop="static">
            <div class="modal-dialog" style="max-width: 750px;">
                <div class="modal-content">
                <div class="modal-header d-flex flex-column">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title">Cuestionario <span class="fw-lighter"><?php echo $dataCuestionarios->tipoCues_tema; ?></span></h5>
                    <p class="fw-lighter">Puedes editar el cuestionario final que has realizado</p>

                    <div class="botonFinalizar m-auto pb-3">        
                        <button type="button" id="agregarPregunta" class="btn btn-warning mt-2 d-inline mb-2">
                            <i class="bi bi-plus-circle-fill"></i>
                            Agregar Pregunta
                        </button>
                    </div>
                </div>
                <div class="modal-body crearCuestionario">
                    <div class="proceso">                
                        <form class="form" method="POST" action="">
                            <div class="proceso_form p-0">
                                <div class="formulario w-100 m-0">

                        
<?php foreach( $dataCuestionarios->preguntasCues as $key => $value ) { 
    $indice = $value->preguntasCues_id; ?>
                                    <div class="pregunta_seccion mb-4">
                                        
                                        <div class="acciones d-flex align-items-center justify-content-between">
                                            <div>
                                                <button type="button" id="agregarRespuesta-1" class="btn btn-primary mt-2 d-inline mb-2 botonAgregarRespuesta">
                                                    <i class="bi bi-plus-circle-fill"></i>
                                                    Agregar Respuesta
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="ajustar-tabla">

                                            <div class="campo">                            
                                                <label for="Pregunta" class="fw-bold text-uppercase pb-2">Pregunta Actual</label>
                                                <input class="form-control" type="text" value="<?php echo $value->preguntasCues_nombre; ?>" id="Pregunta" name="Pregunta" placeholder="Inserta una pregunta a continuacion">                
                                            </div>

        <?php foreach( $dataCuestionarios->respuestas as $key2 => $value2 ) {  
            $indicePregnt = $value2->preguntasCues;
            
            if (  $indice === $indicePregnt )
                { ?>
                                            <div class="campo-respuestas">
                                                <div class="campo pt-2">
                                                    <label for="Respuesta" class="fw-lighter">Respuesta Actual</label>
                                                    <div class="campo_seccion">
                                                        <input class="form-control" type="text" value="<?php echo $value2->respuestasCues_nombre; ?>" id="Respuesta" placeholder="Inserta una respuesta a continuacion">
                                                        <button value="campo_eIEaAEaAUuIOiUoAAEaiUuAIoIiuoa" type="button" class="botonEliminarRespuesta me-3"><i style="font-size:25px;color:red;" class="bi bi-x-circle-fill"></i></button>
                                                    </div>
                                                </div>
                                            </div>
        <?php
            } 
        } 
        ?>
                                        </div>
                                    </div>
<?php } ?>
                                </div>
                            </div>
                        </form>                            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
                </div>
            </div>
        </div>

<?php } ?>