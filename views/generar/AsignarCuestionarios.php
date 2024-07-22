<?php include_once __DIR__ . './../template/header.php'; ?>
        <div class="crearCuestionario">
            <?php include_once __DIR__ . './../template/sidebar.php'; ?>
            <!--
                Aqui vamos a tener todos nuestros usaurios el cual les vamos ir asignando un formulario... 

            -->
            <div class="proceso">
                <div class="descripcion">
                    <h1 class="text-center p-3">Asignacion Cuestionarios</h1>
                    <p class="fw-lighter text-center">Ahora puedes asignar los cuestionarios a tus usuarios</p>
                </div>                
                <div class="panel mx-5">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="bi bi-dot"></i> Id</th>
                                <th class="text-center"><i class="bi bi-person-fill"></i> Nombres</th>
                                <th class="text-center"><i class="bi bi-envelope-check-fill"></i> Correo</th>
                                <th class="text-center"><i class="bi bi-person-rolodex"></i> Rol</th>
                                <th class="text-center"><i class="bi bi-file-ruled-fill"></i> Asignacion Formulario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $key=>$v){  ?>
                            <tr>
                                <td style="vertical-align: middle; font-size:1.5rem;" class="text-center fw-lighter" scope="col"><?php echo $v["usuario_id"]; ?></td>
                                <td style="vertical-align: middle; font-size:1.2rem;" class="text-center fw-lighter"><?php echo $v["usuario_nombre"] . $v["usuario_apellido"]; ?></td>
                                <td style="vertical-align: middle; font-size:1.2rem;" class="text-center fw-lighter"><?php echo $v["usuario_email"]; ?></td>
                                <td style="vertical-align: middle; font-size:1.2rem;" class="text-center fw-lighter">
                                    <p class="btn" style="background-color: #30ea2a; color:#fff;">
                                        <?php echo $v["rol_nombre"]; ?>
                                    </p>
                                </td>
                                <td> 
                                    <form method="POST" action="?accion=generarAsignacionUsuario">
                                        <input type="hidden" name="responsable_<?php echo $v["usuario_id"]; ?>_asignacion_usuarioIdAsignado" value="<?php echo $v["usuario_id"];  ?>"/>
                                        <label for="Cuestionario" class="fw-lighter py-2">Asigna un cuestionario</label>
                                        <select class="form-control" name="responsable_<?php echo $v["usuario_id"]; ?>_asignacion_TipoCuestionarioId" id="Cuestionario">
                                            <option selected="true" value="0" disabled> Asignar Cuestionario </option>
                                            <?php foreach($cues as $ks=>$vs) {  ?>
                                                <option value="<?php echo $vs["tipoCues_id"]; ?>"><?php echo $vs["tipoCues_tema"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="submit" value="Asignar cuestionario" class="btn btn-warning mt-2" name="responsable_<?php echo $v["usuario_id"]; ?>"/>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 
            Dentro de este punto vamos a tirar mensajes en base al tipo de estado del mensaje
        -->
        
        <?php if ( isset($_GET["asignacion"]) ) {  ?>
            <?php if ( $_GET["asignacion"] === "exitoso" ) {     ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    import Swal from 'sweetalert2'

                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "Exitoso",
                    title: "Asignado Correctamente"
                    });
                </script>
            <?php } ?>
        <?php  } ?>
<?php include_once __DIR__ . './../template/footer.php'; ?>