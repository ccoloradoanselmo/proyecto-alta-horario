<?php
require_once __DIR__ . "/Conexion.php";

class ProfesorModelo extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    // Todos los profesores
    public function listar() {
        $sql = "SELECT idProfesores, nombre, apellidos FROM profesores ORDER BY apellidos";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Profesores de una clase concreta
    public function listarPorClase($idClases) {
        $idClases = (int)$idClases;
        $sql = "SELECT DISTINCT p.idProfesores, p.nombre, p.apellidos
                FROM profesores p
                JOIN imparte i ON i.idProfesores = p.idProfesores
                WHERE i.idClases = $idClases
                ORDER BY p.apellidos";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}