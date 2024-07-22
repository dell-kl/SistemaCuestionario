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
<?php include_once __DIR__ . './../template/footer.php'; ?>