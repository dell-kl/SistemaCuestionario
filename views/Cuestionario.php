
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
</head>
<body>
    <header>
        <h1>Cuestionario <?php 
            if ( intval($tipo) === 1)
            {
                echo "Programacion";
            }
            else if ( intval($tipo) === 2 )
            {
                echo "Redes";
            }
            else if ( intval($tipo) === 3 )
            {
                echo "Movil";
            }
        ?></h1>
    </header>

    <?php
        if ( intval($tipo) === 1)
        { ?>

        <form method="POST" action="?accion=registarRespuestas&tipoFormulario=<?php echo $tipo ?>">
            <div class="campos">
                <?php foreach($preguntas as $p){ ?>
                    
                    <div class="campo">
                        <input type="hidden" name="PreguntaId" value="<?php echo $p->preguntasCues_id; ?>">
                        <label for="pregunta-<?php echo $p->preguntasCues_id; ?>"><?php echo $p->preguntasCues_nombre ?></label>
                        
                        <select name="respuesta">
                            <option value="#"> -- Selecciona tu respuesta -- </option>
                            <option value="almacenador">Almacenador</option>
                            <option value="oso">Oso</option>
                            <option value="cosa">Cosa</option>
                        </select>
                    </div>
                <?php }  ?>
                <input type="submit" value="Registrar Respusta">
            </div>
        </form>
    <?php }
        else if ( intval($tipo) === 2 )
        { ?>
            echo "Redes";
    <?php   }
        else if ( intval($tipo) === 3 )
        { ?>
            echo "Movil";
    <?php }
    ?>
</body>
</html>