<?php include_once __DIR__ . './../template/header.php'; ?>
        <div class="crearCuestionario">
            <?php include_once __DIR__ . './../template/sidebar.php'; ?>
            <!--
                Aqui vamos a tener todos nuestros usaurios el cual les vamos ir asignando un formulario... 

            -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Asignacion Formulario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($res as $key=>$v){  ?>
                    <tr>
                        <td><?php echo $v["usuario_id"]; ?></td>
                        <td><?php echo $v["usuario_nombre"] . $v["usuario_apellido"]; ?></td>
                        <td><?php echo $v["usuario_email"]; ?></td>
                        <td><?php echo $v["rol_nombre"]; ?></td>
                        <td>
                            <form method="POST" action="?accion=generarAsignacionUsuario">
                                <input type="hidden" name="responsable_<?php echo $v["usuario_id"]; ?>_asignacion_usuarioIdAsignado" value="<?php echo $v["usuario_id"];  ?>"/>
                                <label for="Cuestionario">Asigna un cuestionario</label>
                                <select name="responsable_<?php echo $v["usuario_id"]; ?>_asignacion_TipoCuestionarioId" id="Cuestionario">
                                    <option selected="true" value="0" disabled> Asignar Cuestionario </option>
                                    <?php foreach($cues as $ks=>$vs) {  ?>
                                        <option value="<?php echo $vs["tipoCues_id"]; ?>"><?php echo $vs["tipoCues_tema"]; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="submit" value="Asignar cuestionario" name="responsable_<?php echo $v["usuario_id"]; ?>"/>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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