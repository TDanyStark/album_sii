<?php
require_once '../modelos/db.php';
if ($conn === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

SESSION_START();

$usuario = $_SESSION['usuario'];

if ($usuario != 'admin23 2023@;'){
    header('Location: home');
}
?>
<?php require_once '../vistas/comunes/header.php';?>

<?php 
$sql = "SELECT * FROM pacientes";
$result = mysqli_query($conn, $sql);
$pacientes = mysqli_fetch_all($result, MYSQLI_ASSOC); 


$sql2 = "SELECT pacientes.nombre_paciente, DATE_ADD(progreso.fecha_interaccion, INTERVAL 1 HOUR) AS fecha_interaccion, progreso.completed, usuarios.nombre, usuarios.cedula FROM pacientes INNER JOIN progreso ON progreso.paciente_id = pacientes.id INNER JOIN usuarios ON usuarios.id = progreso.usuario_id";
$result2 = mysqli_query($conn, $sql2);
$progresos = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// // capturar usuarios unicos en la tabla progresos

// $sql3 = "SELECT DISTINCT usuarios.nombre, usuarios.cedula FROM usuarios INNER JOIN progreso ON progreso.usuario_id = usuarios.id";
// $result3 = mysqli_query($conn, $sql3);
// $usuarios = mysqli_fetch_all($result3, MYSQLI_ASSOC);

require_once '../vistas/dashboard.php';

?>

<?php require_once '../vistas/comunes/footer.php';?>
