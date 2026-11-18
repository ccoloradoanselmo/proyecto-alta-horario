<?php
require_once __DIR__ . "/Conexion.php";

class UsuarioModelo extends Conexion {
    public function __construct() {
        parent::__construct();
    }


    public function listarUsuarios() {
        $sql = "SELECT idUsuario, correo, perfil FROM usuarios";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarUsuario($correo, $pw){
        $correo = $this->db->real_escape_string($correo);
        $pw = $this->db->real_escape_string($pw);
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND pw = '$pw'";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

}

