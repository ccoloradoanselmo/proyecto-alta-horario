<?php
require_once "modelos/ClaseModelo.php";
require_once "modelos/AsignaturaModelo.php";
require_once "modelos/ProfesorModelo.php";
require_once "modelos/HorarioModelo.php";
require_once "modelos/UsuarioModelo.php";
require_once "controladores/HorarioControlador.php";


class InicioControlador{
    public $vista;
    public $mensaje = "";

    public function inicio(){
        $this->vista = "index.html";
    }

      public function formularioLogin(){
        $this->vista = "vlogin.php";
    }

    public function login(){
        // Recogemos lo que envía el formulario (vacío si no viene nada)
        $correo = $_POST["email"] ?? "";
        $pw = $_POST["password"] ?? "";

        // Si falta algo, avisamos y volvemos a pintar el login
        if($correo === "" || $pw === "") {
            $this->mensaje = "Correo o contraseña vacíos...";
            return $this->formularioLogin();
        }

        // Buscamos en BD: ¿existe un usuario con ese email y password?
        $usuario = (new UsuarioModelo())->buscarUsuario($correo, $pw);

        // Si no existe, mismo trato: mensaje de error y otra oportunidad
        if(empty($usuario)) {
            $this->mensaje = "Correo o contraseña incorrectos...";
            return $this->formularioLogin();
        }

        // Todo ok: guardamos mensaje de bienvenida, elegimos la vista siguiente
        // y delegamos en HorarioControlador para que prepare los datos del formulario
        $this->mensaje = "Has iniciado sesión como ".$correo;
        $this->vista = "vformulario.php";
        return (new HorarioControlador())->formulario();
    }
    
    
}