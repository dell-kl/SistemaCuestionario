<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./wwwroot/css/formulario.css"/>
    <title>Document</title>
</head>
<body>
    <div class="sesion">
        <h1 class="text-center pt-2">Inicio Sesion</h1>

        <div class="formulario p-2">
            <form action="?accion=sesionValidar" method="post">
                <div class="campos">
                    <div class="campo">
                        <label for="Email" class="fw-bold">Email:</label>
                        <input type="email" class="form-control" name="Email" id="Email" placeholder="Inserta un email a continuacion">
                    </div>
                    <div class="campo">
                        <div class="Password" class="fw-bold">Password:</div>
                        <input type="password" class="form-control" name="Password" id="Password" placeholder="Inserta un password a continuacion">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Iniciar Sesion">
                </div>
            </form>
            <div class="acciones">
                <a href="?accion=registro">No tienes una cuenta aun? Registrar Cuenta</a>
            </div>
        </div>
    </div>
</body>
</html>