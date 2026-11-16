<?php
require_once "modelos/ClaseModelo.php";
require_once "modelos/AsignaturaModelo.php";
require_once "modelos/ProfesorModelo.php";
require_once "modelos/HorarioModelo.php";


class InicioControlador{
    public $vista;
    public $mensaje = "";

    public function inicio(){
        $this->vista = "index.html";
    }

    
}