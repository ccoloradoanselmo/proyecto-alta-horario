<?php
require_once __DIR__ . "/Conexion.php";

class ClaseModelo extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    // Todas las clases
    public function listar() {
        $sql = "SELECT idClases, nombre FROM clases ORDER BY nombre";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Clases que todavía no tienen ningún horario
    public function listarSinHorario() {
        // Subconsulta para sacar las clases que NO tienen horario
        $sql = "SELECT idClases, nombre FROM clases
                WHERE idClases NOT IN (SELECT idClases FROM horario)
                ORDER BY nombre";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}