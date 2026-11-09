<?php
require_once "modelos/ClaseModelo.php";
require_once "modelos/AsignaturaModelo.php";
require_once "modelos/ProfesorModelo.php";
require_once "modelos/HorarioModelo.php";

class HorarioControlador {
    public $vista;
    public $datos = [];
    public $mensaje = "";

    // Paso 1: elegir clase
    public function formulario() {
        $this->datos['clases'] = (new ClaseModelo())->listarSinHorario();
        $this->vista = "vformulario";
    }

    // Paso 2: tabla del horario de la clase elegida
    public function horario() {
        $idClases = (int)($_POST['idClases'] ?? 0);

        // Si no eligió clase, volvemos al paso 1
        if ($idClases == 0) {
            $this->formulario();
            return; 
        }

        $this->datos['idClases'] = $idClases;
        $this->datos['asignaturas'] = (new AsignaturaModelo())->listarPorClase($idClases);
        $this->datos['profesores'] = (new ProfesorModelo())->listarPorClase($idClases);
        $this->vista = "vhorario";
    }

    // Paso 3: guardar
    public function alta() {
        $idClases = (int)($_POST['idClases'] ?? 0);

        $dias  = ['L' => 'lunes', 'M' => 'martes', 'X' => 'miercoles', 'J' => 'jueves', 'V' => 'viernes'];
        $filas = [];
        $error = false;

        foreach ($dias as $letra => $nombreDia) {
            for ($hora = 1; $hora <= 7; $hora++) {
                $asig = $_POST[$nombreDia . "_" . $hora . "_asignatura"] ?? "";
                $prof = $_POST[$nombreDia . "_" . $hora . "_profesor"] ?? "";

                // Celda vacía: se ignora
                if ($asig == "" && $prof == "") {
                    continue;
                }
                // Celda a medias: error
                if ($asig == "" || $prof == "") {
                    $error = true;
                    continue;
                }

                $filas[] = [
                    'dia' => $letra,
                    'hora' => $hora,
                    'clase' => $idClases,
                    'asignatura' => $asig,
                    'profesor'=> $prof
                ];
            }
        }

        // Si no ha rellenado nada, también es error
        if (count($filas) == 0) {
            $error = true;
        }

        if (!$error && (new HorarioModelo())->altaVarias($filas)) {
            $this->mensaje = "Horario guardado correctamente";
            $this->formulario();
        } else {
            $this->mensaje = "Ha habido un error";
            $this->horario();
        }
    }
}