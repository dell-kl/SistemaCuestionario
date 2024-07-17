<?php
    if ( isset($_GET["id"]) )
    { ?>
        <div class="modal" tabindex="-1" style="display:block;" data-bs-backdrop="static">
            <div class="modal-dialog" style="max-width: 750px;">
                <div class="modal-content">
                <div class="modal-header d-flex flex-column">
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
                        <!-- Actualizar nuevamente nuestro formulario. -->
                        <form class="form" method="POST" action="?accion=actualizarFormulario">
                            <div class="proceso_form p-0">
                                <div class="formulario w-100 m-0">                        
<?php foreach( $dataCuestionarios->preguntasCues as $key => $value ) { 
    $indicePregunta = md5($value->preguntasCues_id*15);
    $indice = $value->preguntasCues_id; ?>
                                    <input type="hidden" name="preguntaCuestionario_<?php echo $indicePregunta; ?>" value="<?php echo $indice; ?>"/>
                                    <div class="pregunta_seccion mb-4">
                                        
                                        <div class="acciones d-flex align-items-center justify-content-between">
                                            <div>
                                                <button type="button" id="agregarRespuesta-<?php echo $indicePregunta; ?>" class="btn btn-primary mt-2 d-inline mb-2 botonAgregarRespuesta">
                                                    <i class="bi bi-plus-circle-fill"></i>
                                                    Agregar Respuesta
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="tabla ajustar-tabla">
                                            <div class="campo-pregunta">                            
                                                <label for="Pregunta<?php echo $indicePregunta; ?>" class="fw-bold text-uppercase pb-2">Pregunta Actual</label>
                                                <input class="form-control" type="text" value="<?php echo $value->preguntasCues_nombre; ?>" id="Pregunta<?php echo $indicePregunta; ?>" name="Pregunta_<?php echo $indicePregunta; ?>" placeholder="Inserta una pregunta a continuacion">                
                                            </div>
                                            <div class="campo-respuestas agregarRespuesta-<?php echo $indicePregunta; ?>">
        <?php foreach( $dataCuestionarios->respuestas as $key2 => $value2 ) {  
            $indiceRespuesta = md5($indiceRespuesta);
            $indicePregnt = $value2->preguntasCues;
            $respuestaCorrecta = intval($value2->respuestasCues_correcta);

            if (  $indice === $indicePregnt )
                { ?>

                                                <div class="campo pt-2 campo_<?php echo $indiceRespuesta; ?>">
                                                    <label for="Respuesta<?php echo $indiceRespuesta; ?>" class="fw-lighter">Respuesta Actual</label>
                                                    <div class="campo_seccion">
                                                        <input type="hidden" name="respuestasCuestionario_<?php echo $indiceRespuesta; ?>" value="<?php echo $value2->respuestasCues_id; ?>" />
                                                        <input class="form-control" name="pregunta_<?php echo $indicePregunta; ?>_respuesta_<?php echo $indiceRespuesta; ?>" type="text" value="<?php echo $value2->respuestasCues_nombre; ?>" id="Respuesta<?php echo $indiceRespuesta; ?>" placeholder="Inserta una respuesta a continuacion">
                                                        <button value="campo_<?php echo $indiceRespuesta; ?>" type="button" class="botonEliminarRespuesta me-5"><i style="font-size:25px;color:red;" class="bi bi-x-circle-fill"></i></button>
                                                        <?php /* Dentro de este punto vamos a realizar una validacion sobre la respuesta correcta.... */ ?>
                                                        <?php if ( $respuestaCorrecta === 0 ){ ?>
                                                            <div class="form-check form-switch switch_encenderRespuestaCorrecta">
                                                                <input class="form-check-input" name="pregunta_<?php echo $indicePregunta; ?>_respuesta_<?php echo $indiceRespuesta; ?>_correcta" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                            </div>
                                                        <?php } else if ( $respuestaCorrecta === 1 )
                                                        { ?>
                                                            <div class="form-check form-switch switch_encenderRespuestaCorrecta">
                                                                <input class="form-check-input" name="pregunta_<?php echo $indicePregunta; ?>_respuesta_<?php echo $indiceRespuesta; ?>_correcta" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
        <?php
            } 
        } 
        ?>
                                            </div>
                                        </div>
                                    </div>
<?php } ?>
                                </div>
                            </div>
                            <input type="submit" id="btn-formularioFinal" value="Enviar Datos Formulario" style="display:none;"/>
                        </form>                            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="CerrarFormularioFinal" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-guardarCambiosFormulario">Guardar Cambios</button>
                </div>
                </div>
            </div>
        </div>

<?php } ?>