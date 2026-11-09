<?php
require_once __DIR__ . "/Conexion.php";

class HorarioModelo extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    // Da de alta UNA sesión del horario
    public function alta($dia, $hora, $idClases, $idAsignatura, $idProfesores)
    {
        $dia = $this->db->real_escape_string($dia); // Devuelve la string sin carácteres raros
        $hora = (int) $hora;
        $idClases = (int) $idClases;
        $idAsignatura = (int) $idAsignatura;
        $idProfesores = (int) $idProfesores;

        $sql = "INSERT INTO horario (dia_semana, hora, idClases, idAsignatura, idProfesores)
                VALUES ('$dia', $hora, $idClases, $idAsignatura, $idProfesores)";
        return $this->db->query($sql);
    }

    // Da de alta varias filas de la tabla del formulario de una vez
    public function altaVarias($filas)
    {
        $this->db->begin_transaction();
        try {
            foreach ($filas as $f) {
                $this->alta($f['dia'], $f['hora'], $f['clase'], $f['asignatura'], $f['profesor']);
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    // ¿Ya hay algo en ese hueco para esa clase?
    public function huecoOcupado($idClases, $dia, $hora)
    {
        $idClases = (int) $idClases;
        $dia = $this->db->real_escape_string($dia);
        $hora = (int) $hora;

        $sql = "SELECT COUNT(*) AS total FROM horario
                WHERE idClases = $idClases AND dia_semana = '$dia' AND hora = $hora";
        $fila = $this->db->query($sql)->fetch_assoc();
        return $fila['total'] > 0;
    }

    // ¿Esa clase tiene esa asignatura con ese profesor? (tabla imparte)
    public function imparteValido($idClases, $idAsignatura, $idProfesores)
    {
        $idClases = (int) $idClases;
        $idAsignatura = (int) $idAsignatura;
        $idProfesores = (int) $idProfesores;

        $sql = "SELECT COUNT(*) AS total FROM imparte
                WHERE idClases = $idClases AND idAsignatura = $idAsignatura AND idProfesores = $idProfesores";
        $fila = $this->db->query($sql)->fetch_assoc();
        return $fila['total'] > 0;
    }

    
    // Para mostrar el horario de un clase
    public function listarPorClase($idClases)
    {
        $idClases = (int) $idClases;
        $sql = "SELECT h.dia_semana, h.hora, a.nombre AS asignatura,
                   CONCAT(p.nombre, ' ', p.apellidos) AS profesor
            FROM horario h
            JOIN asignaturas a ON a.idAsignatura = h.idAsignatura
            JOIN profesores p ON p.idProfesores = h.idProfesores
            WHERE h.idClases = $idClases
            ORDER BY h.hora, h.dia_semana";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}