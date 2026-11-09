<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alta de horario - Elegir clase</title>
  <link rel="stylesheet" href="./vistas/estilos.css">
</head>
<body>
  <form class="tarjeta estrecha" action="index.php" method="post">
    <input type="hidden" name="controlador" value="Horario">
    <input type="hidden" name="metodo" value="horario">

    <h1>Alta de horario</h1>

    <?php if ($mensaje != "") { ?>
      <p class="ayuda"><?php echo $mensaje; ?></p>
    <?php } ?>

    <p class="ayuda">Elige la clase para la que vas a crear el horario.</p>

    <label class="campo" for="clase">Clase</label>

    <select class="grande" id="clase" name="idClases" required>
      <option value="">Selecciona una clase</option>
      <?php foreach ($datos['clases'] as $clase) { ?>
        <option value="<?php echo $clase['idClases']; ?>"><?php echo $clase['nombre']; ?></option>
      <?php } ?>
    </select>

    <div class="acciones">
      <input type="submit" value="Siguiente">
    </div>
  </form>
</body>
</html>