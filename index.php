<?php
// 1. Controlador y método recibidos por POST (con valores por defecto)
$controlador = $_POST['controlador'] ?? 'Horario';
$metodo = $_POST['metodo'] ?? 'formulario';

// 2. Seguridad básica: solo letras, para que no puedan cargar otros archivos
if (!ctype_alpha($controlador) || !ctype_alpha($metodo)) {
    die("Petición no válida");
}

$archivo = __DIR__ . "/controladores/{$controlador}Controlador.php";

if (!file_exists($archivo)) {
    die("Controlador no encontrado");
}

// 3. Cargamos y creamos el controlador
require_once $archivo;
$clase = $controlador . "Controlador";
$obj = new $clase();

if (!method_exists($obj, $metodo)) {
    die("Método no encontrado");
}

// 4. Ejecutamos el método (él decide la vista y rellena los datos)
$obj->$metodo();

// 5. Pasamos los datos y el mensaje a la vista y la cargamos
$datos = $obj->datos;
$mensaje = $obj->mensaje;
require __DIR__ . "/vistas/" . $obj->vista . ".php";