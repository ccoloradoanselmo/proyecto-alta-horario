<?php
// Datos de presentación de la tabla
$dias = [
  'lunes' => 'Lunes',
  'martes' => 'Martes',
  'miercoles' => 'Miércoles',
  'jueves' => 'Jueves',
  'viernes' => 'Viernes'
];

$horas = [
  1 => '8:15 - 9:10',
  2 => '9:10 - 10:05',
  3 => '10:05 - 11:00',
  4 => '11:30 - 12:25',
  5 => '12:25 - 13:20',
  6 => '13:20 - 14:15',
  7 => '14:15 - 15:00'
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alta de horario - Horario</title>
  <link rel="stylesheet" href="./vistas/estilos.css">
</head>

<body class="horario">
  <form class="tarjeta ancha" action="index.php" method="post">
    <input type="hidden" name="controlador" value="Horario">
    <input type="hidden" name="metodo" value="alta">
    <?php
    echo '<input type="hidden" name="idClases" value="' . $datos['idClases'] . '">';
    ?>

    <div class="cabecera">
      <h1>Horarios</h1>
    </div>

    <?php
    if ($mensaje != "") {
      echo '<p class="ayuda">' . $mensaje . '</p>';
    }
    ?>

    <div class="tabla-scroll">
      <table>
        <thead>
          <tr>
            <th scope="col">Hora</th>
            <?php
            foreach ($dias as $nombreDia) {
              echo '<th scope="col">' . $nombreDia . '</th>';
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($horas as $numHora => $textoHora) {

            // El recreo va justo antes de la hora 4
            if ($numHora == 4) {
              echo '<tr class="recreo">';
              echo '<th scope="row" colspan="6">11:00 - 11:30 &nbsp; RECREO</th>';
              echo '</tr>';
            }

            echo '<tr>';
            echo '<th scope="row">' . $textoHora . '</th>';

            foreach ($dias as $claveDia => $nombreDia) {

              // La hora 7 solo existe el lunes
              if ($numHora == 7 && $claveDia != 'lunes') {
                echo '<td class="bloqueado" title="Franja no disponible"></td>';
              } else {
                echo '<td>';

                // Desplegable de asignaturas
                echo '<select class="asignatura" name="' . $claveDia . '_' . $numHora . '_asignatura" aria-label="Asignatura, ' . $nombreDia . ', ' . $textoHora . '">';
                echo '<option value="">Asignatura</option>';
                foreach ($datos['asignaturas'] as $a) {
                  echo '<option value="' . $a['idAsignatura'] . '">' . $a['nombre'] . '</option>';
                }
                echo '</select>';

                // Desplegable de profesores
                echo '<select class="profesor" name="' . $claveDia . '_' . $numHora . '_profesor" aria-label="Profesor, ' . $nombreDia . ', ' . $textoHora . '">';
                echo '<option value="">Profesor</option>';
                foreach ($datos['profesores'] as $p) {
                  echo '<option value="' . $p['idProfesores'] . '">' . $p['nombre'] . ' ' . $p['apellidos'] . '</option>';
                }
                echo '</select>';

                echo '</td>';
              }
            }

            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="acciones">
      <a class="volver" href="index.php">Cambiar de clase</a>
      <input type="submit" value="Guardar horario">
    </div>
  </form>
</body>

</html>