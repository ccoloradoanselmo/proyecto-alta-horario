<?php
require_once __DIR__ . "/../configdb.php";

class Conexion {
    protected $db;

    protected function __construct() {
        $this->db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BD);
        $this->db->set_charset("utf8mb4");
    }
}