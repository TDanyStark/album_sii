<?php
require_once '../modelos/db.php';

if ($conn === false) {
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}

SESSION_START();

if (isset($_SESSION['usuario'])) {
    header("Location: home");
}
?>
<?php require_once '../vistas/comunes/header.php';?>

<?php require_once '../vistas/login.php';?>

<?php require_once '../vistas/comunes/footer.php';?>
