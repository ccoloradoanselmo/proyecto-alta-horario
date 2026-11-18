<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="./vistas/estilos.css">
</head>

<body>
    <main class="login-page">
        <form class="tarjeta estrecha" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Inicio">
            <input type="hidden" name="metodo" value="login">

            <h1>Iniciar sesión</h1>

            <?php if ($mensaje != "") { ?>
                <p class="ayuda">
                    <?php echo $mensaje; ?>
                </p>
            <?php } ?>

            <label class="campo" for="email">Correo</label>
            <input type="email" id="email" name="email" required>

            <label class="campo" for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <div class="acciones">
                <input type="submit" value="Entrar">
            </div>
        </form>
    </main>

</body>

</html>