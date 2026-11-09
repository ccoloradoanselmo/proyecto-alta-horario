<?php
require_once __DIR__ . "/Conexion.php";

class AsignaturaModelo extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    // Todas las asignaturas
    public function listar() {
        $sql = "SELECT idAsignatura, nombre FROM asignaturas ORDER BY nombre";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Asignaturas de una clase concreta
    public function listarPorClase($idClases) {
        $idClases = (int)$idClases;
        $sql = "SELECT DISTINCT a.idAsignatura, a.nombre
                FROM asignaturas a
                JOIN imparte i ON i.idAsignatura = a.idAsignatura
                WHERE i.idClases = $idClases
                ORDER BY a.nombre";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}