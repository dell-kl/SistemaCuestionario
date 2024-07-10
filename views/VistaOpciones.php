<?php 
include_once __DIR__ . '/template/header.php'; ?>
        <div class="crearCuestionario">            
            <?php include_once __DIR__ . '/template/sidebar.php'; ?>
                <div class="proceso">
                    <h1 class="text-center pt-4 fw-bold">Cuestionarios Creados</h1>
                    <p class="text-center fw-lighter">Puedes hacer una gestion de tus cuestionarios desde aqui</p>

                    <div class="cuestionarios">
                        <?php foreach($resultado as $res){  
                            if(intval($res["tipoCues_id"])%2==0){ ?>
                                <div class="cuestionario ps-2 bg_naranja d-flex flex-column">
                                    <p class="fw-bold pt-2 text-white">Cuestionario ID: <?php echo $res["tipoCues_id"]; ?></p>
                                    <div class="acciones">
                                        <a class="btn btn-danger" href="?accion=eliminarCuestionario&id=<?php echo $res["tipoCues_id"]; ?>">🗑️</a>
                                        <a href="?accion=opciones&id=<?php echo $res["tipoCues_id"]; ?>" id="botonVerEdit" class="btn btn-warning">👁️</a>
                                    </div>
                                    <div class="tema pt-2">
                                        <p class="text-white"><span class="fw-bold">Tema Cuestionario:</span> <span class="fw-lighter"><?php echo $res["tipoCues_tema"]; ?></span></p>
                                    </div>
                                </div>
                            <?php }else{ ?> 
                                <div class="cuestionario bg_marino ps-2">
                                    <p class="fw-bold pt-2 text-white">Cuestionario ID: <?php echo $res["tipoCues_id"]; ?></p>
                                    <div class="acciones">
                                        <a class="btn btn-danger" href="?accion=eliminarCuestionario&id=<?php echo $res["tipoCues_id"]; ?>">🗑️</a>
                                        <a href="?accion=opciones&id=<?php echo $res["tipoCues_id"]; ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  id="botonVerEdit" class="btn btn-warning">👁️</a>
                                    </div>
                                    <div class="tema pt-2">
                                        <p class="text-white"><span class="fw-bold">Tema Cuestionario:</span> <span class="fw-lighter"><?php echo $res["tipoCues_tema"]; ?></span></p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
        </div>

        <?php include_once __DIR__ . '/template/formulario.php'; ?>

<?php include_once __DIR__ . '/template/footer.php'; ?>