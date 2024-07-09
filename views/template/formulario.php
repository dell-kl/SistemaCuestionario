<?php
    $cuestionarioFinal = [];
    if ( isset($_GET["id"]) )
    {
        foreach($dataCuestionarios as $key => $value)
        {
        
            if ( intval($value->tipoCues_id) === intval($_GET["id"]) )
            {
                $cuestiFin = null;

                if (count( $cuestionarioFinal ) === 0)
                {
                    $cuestiFin = new CuestionarioFinal(
                        $value->tipoCues_id,
                        $value->tipoCues_tema,
                        $value->preguntasCues_id,
                        $value->preguntasCues_nombre,
                        new RespuestasCues(0, "", 0)
                    );
                }
                else 
                {
                    if ( $cuestionarioFinal[count($cuestionarioFinal)-1]->preguntasCues_id !== $value->preguntasCues_id)
                    {
                        $cuestiFin = new CuestionarioFinal(
                            $value->tipoCues_id,
                            $value->tipoCues_tema,
                            $value->preguntasCues_id,
                            $value->preguntasCues_nombre,
                            new RespuestasCues(0, "", 0)
                        );
                    }
                }

                if ( $cuestiFin !== null)
                    $cuestionarioFinal[] = $cuestiFin;

                break;
            }

        }
    }

?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cuestionario Final</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="informacion_cuestionario">
            <div class="campos">
                <div class="campo">
                    <p>Tema Cuestionario: <input type="test" name="TemaCuestionario" value="<?php ?>/></p>
                    <input type="hidden" name="preguntasCues_id" value="<?php  ?>">
                </div>
                <?php if ($cuestionarioFinal !== null) { ?> 
                    <?php foreach($cuestionarioFinal as $key=>$value) {  ?>
                            <div class="campo-pregunta">
                                <label for="pregunta" class="fw-light pb-2">Pregunta Generada</label>
                                <input type="text" id="pregunta" value="<?php echo $value->preguntasCues_nombre; ?>" name="pregunta_<?php echo $value->preguntasCues_id; ?>" class="form-control" placeholder="Ingresa primera pregunta para el cuestionario">
                            </div>  
                            
                            <?php foreach($dataCuestionarios as $key => $value2){  
                                if ( $value->preguntasCues_id === $value2->preguntasCues_id ) { ?>

                                <div class="campo-respuestas">
                                    <div class="campo">
                                        <label for="pregunta" class="fw-light pb-2">Respuesta cuestionario</label>
                                        <input type="text" value="<?php echo ( $value2->respuestas->respuestasCues_nombre ); ?>" name="pregunta_<?php echo $value->preguntasCues_id; ?>_respuesta_<?php echo $value2->respuestas->respuestasCues_id; ?>" class="form-control respuesta" placeholder="Ingresa la respuesta para la pregunta">                        
                                    </div>
                                </div>
                            <?php 
                                }
                            } ?> 
                    <?php } ?> 
                <?php } ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>