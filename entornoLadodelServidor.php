//código PHP que conecta el archivo HTML con el servidor


<?php
require_once 'conexion.php'; // Trae la conexión aquí

$seccion_actual = isset($_GET['seccion']) ? $_GET['seccion'] : 'inicio';

// Variable para mostrar mensajes de éxito o error
$mensaje_db = "";
?>
<?php
// 1. Detectamos qué sección se solicita a través de la URL (?seccion=...)
// Si no hay ninguna secesión en la URL, por defecto asignamos 'inicio'
$seccion_actual = isset($_GET['seccion']) ? $_GET['seccion'] : 'inicio';
?>